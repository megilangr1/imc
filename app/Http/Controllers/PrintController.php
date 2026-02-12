<?php

namespace App\Http\Controllers;

use App\Helpers\MainHelper;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrintController extends Controller
{
    public function cetakInvoice($uuid)
    {
        try {
            $user = Auth::user();
            $data = Penjualan::with(['detail'])->where('uuid', '=', $uuid);
            $data = $data->firstOrFail();

            $detail = [];

            foreach ($data->detail as $key => $value) {
                $detail[] = [
                    'item' => $value['item'],
                    'jumlah' => number_format($value['jumlah'], 0, ',', '.'),
                    'harga' => number_format($value['harga'], 2, ',', '.'),
                    'sub_total' => number_format($value['jumlah'] * $value['harga'], 2, ',', '.'),
                ];
            }

            $print = [
                'data' => [
                    'nomor_nota' => $data->nomor_nota,
                    'nama_pekerjaan' => $data->nama_pekerjaan,
                    'tempat_pekerjaan' => $data->tempat_pekerjaan,
                    'tanggal_pekerjaan' => (new MainHelper)->dateFormatIndo($data->tanggal_pekerjaan),
                    'pemilik_pekerjaan' => $data->pemilik_pekerjaan,
                    'total_nominal' => number_format($data->total_nominal, 2, ',', '.'),
                    'detail' => $detail,
                ],
                'penanda_tangan' => [
                    'tanda_terima_pekerjaan' => $data->tanda_terima_pekerjaan,
                    'nama_pengguna' => $user->name,
                ],
                'info_cetak' => [
                    'tanggal_cetak' => (new MainHelper)->dateFormatIndo(now()),
                    'nama_pencetak' => Auth::user()->name,
                ],
            ];

            $pdf = Pdf::loadView('print.invoice', $print)
                ->setPaper('A5', 'landscape')
                ->setOption('enable-local-file-access', true);

            return $pdf->stream('E-SPPT-' . $data->nop . '-' . date('mdYHis') . '.pdf');
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    public function cetakKuitansi($uuid)
    {
        try {
            $user = Auth::user();
            $data = Penjualan::with(['detail'])->where('uuid', '=', $uuid);
            $data = $data->firstOrFail();

            $detail = [];

            foreach ($data->detail as $key => $value) {
                $detail[] = [
                    'item' => $value['item'],
                    'jumlah' => number_format($value['jumlah'], 0, ',', '.'),
                    'harga' => number_format($value['harga'], 2, ',', '.'),
                    'sub_total' => number_format($value['jumlah'] * $value['harga'], 2, ',', '.'),
                ];
            }

            $print = [
                'data' => [
                    'nomor_nota' => $data->nomor_nota,
                    'nama_pekerjaan' => $data->nama_pekerjaan,
                    'tempat_pekerjaan' => $data->tempat_pekerjaan,
                    'tanggal_pekerjaan' => (new MainHelper)->dateFormatIndo($data->tanggal_pekerjaan),
                    'pemilik_pekerjaan' => $data->pemilik_pekerjaan,
                    'total_nominal' => number_format($data->total_nominal, 2, ',', '.'),
                    'total_nominal_terbilang' => ucwords((new MainHelper)->terbilang($data->total_nominal)),
                    'detail' => $detail,
                ],
                'penanda_tangan' => [
                    'tanda_terima_pekerjaan' => $data->tanda_terima_pekerjaan,
                    'nama_pengguna' => $user->name,
                ],
                'info_cetak' => [
                    'tanggal_cetak' => (new MainHelper)->dateFormatIndo(now()),
                    'nama_pencetak' => Auth::user()->name,
                ],
            ];

            $pdf = Pdf::loadView('print.kuitansi', $print)
                ->setPaper('A5', 'landscape')
                ->setOption('enable-local-file-access', true);

            return $pdf->stream('E-SPPT-' . $data->nop . '-' . date('mdYHis') . '.pdf');
        } catch (\Throwable $th) {
            dd($th);
            abort(500);
        }
    }
}
