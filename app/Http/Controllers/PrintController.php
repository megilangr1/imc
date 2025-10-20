<?php

namespace App\Http\Controllers;

use App\Helpers\MainHelper;
use App\Models\Pengajuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function cetakResumePengajuan($uuid)
    {
        try {
            $data = Pengajuan::with([
                'skpd'
            ])->where('uuid', '=', $uuid)->firstOrFail();

            $print = [
                'skpd' => [
                    'kode_skpd' => $data->skpd->kode_skpd,
                    'nama_skpd' => $data->skpd->nama_skpd,
                ],
                'data' => [
                    [
                        'info' => 'Jenis Pengajuan',
                        'value' => $data->nama_jenis_pengajuan,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Kegiatan',
                        'value' => $data->kegiatan,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Sub Kegiatan',
                        'value' => $data->sub_kegiatan,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Pekerjaan',
                        'value' => $data->pekerjaan,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Kode Rekening Belanja',
                        'value' => $data->kode_rekening_belanja,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Nama Rekening Belanja',
                        'value' => $data->nama_rekening_belanja,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Sumber Dana',
                        'value' => $data->sumber_dana,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Nomor SP / SPK',
                        'value' => $data->nomor_sp_spk,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Lokasi',
                        'value' => $data->lokasi,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Nomor SPM',
                        'value' => $data->nomor_spm,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Tanggal SPM',
                        'value' => $data->tanggal_spm != null ? (new MainHelper)->dateFormatIndo($data->tanggal_spm) : null,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Nominal',
                        'value' => 'Rp. ' . number_format($data->nominal, 0, ',', '.'),
                        'bold' => true,
                    ],
                    [
                        'info' => 'Nama Pihak Ketiga',
                        'value' => $data->nama_pihak_ketiga,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Kualifikasi',
                        'value' => $data->kualifikasi,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Nomor Rekening',
                        'value' => $data->nomor_rekening,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Nama Bank',
                        'value' => $data->nama_bank,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Jangka Kontrak',
                        'value' => $data->jangka_kontrak,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Tanggal Mulai Pekerjaan',
                        'value' => $data->tanggal_mulai_pekerjaan != null ? (new MainHelper)->dateFormatIndo($data->tanggal_mulai_pekerjaan) : '',
                        'bold' => false,
                    ],
                    [
                        'info' => 'Tanggal Selesai Pekerjaan',
                        'value' => $data->tanggal_selesai_pekerjaan != null ? (new MainHelper)->dateFormatIndo($data->tanggal_selesai_pekerjaan) : '',
                        'bold' => false,
                    ],
                    [
                        'info' => 'Jenis Belanja',
                        'value' => $data->jenis_belanja,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Jenis Pembayaran',
                        'value' => $data->jenis_pembayaran,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Pembayaran Bulan',
                        'value' => $data->nama_bulan,
                        'bold' => false,
                    ],
                    [
                        'info' => 'Keterangan',
                        'value' => $data->keterangan,
                        'bold' => false,
                    ],
                ],
                'penanda_tangan' => [
                    'nip_pa_kpa' => $data->nip_pa_kpa,
                    'nama_pa_kpa' => $data->nama_pa_kpa,
                    'jabatan_pa_kpa' => $data->jabatan_pa_kpa,
                    'nip_ppk' => $data->nip_ppk,
                    'nama_ppk' => $data->nama_ppk,
                    'jabatan_ppk' => $data->jabatan_ppk,
                ],
                'tanggal_cetak' => (new MainHelper)->dateFormatIndo(now()),
            ];

            $pdf = Pdf::loadView('print.pengajuan.cetak-resume', $print)
                ->setPaper('a4')
                ->setOption('enable-local-file-access', true);

            return $pdf->stream('Resume' . date('mdY_His') . $data->id  . '.pdf');
        } catch (\Throwable $th) {
            dd($th);
            abort(500);
        }
    }
}
