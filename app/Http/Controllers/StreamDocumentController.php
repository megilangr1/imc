<?php

namespace App\Http\Controllers;

use App\Helpers\MainHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StreamDocumentController extends Controller
{
    /**
     * Menampilkan file publik.
     */
    public function getPublicFile(string $folder, string $filename)
    {
        return $this->serveFile('public-path', $folder, $filename, false);
    }

    /**
     * Mengunduh file publik.
     */
    public function downloadPublicFile(Request $request, string $folder, string $filename)
    {
        return $this->serveFile('public-path', $folder, $filename, true);
    }

    /**
     * Menampilkan atau mengunduh file privat.
     */
    public function getPrivateFile(Request $request, string $folder, string $filename)
    {
        $isDownload = $request->isMethod('post');
        return $this->serveFile('private-path', $folder, $filename, $isDownload);
    }

    /**
     * Core logic untuk stream/download file.
     */
    protected function serveFile(string $disk, string $folder, string $filename, bool $download = false)
    {
        try {
            // Cegah path traversal: hanya izinkan karakter aman
            $folder = basename($folder);
            $filename = basename($filename);

            $path = $folder . '/' . $filename;

            if (!Storage::disk($disk)->exists($path)) {
                return response()->file(public_path('img/no-image.png'));
            }

            // Ambil file path absolut
            $absolutePath = Storage::disk($disk)->path($path);

            // Jika request download
            if ($download) {
                return response()->download($absolutePath, $filename, [
                    'Content-Type' => mime_content_type($absolutePath),
                ]);
            }

            // Jika hanya tampil (stream)
            return response()->file($absolutePath, [
                'Content-Type' => mime_content_type($absolutePath),
            ]);
        } catch (\Throwable $e) {
            report($e);
            return response()->file(public_path('img/no-image.png'));
        }
    }
}
