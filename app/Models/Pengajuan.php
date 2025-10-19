<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Pengajuan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'id_skpd',
        'kode_skpd',
        'nama_skpd',
        'kode_jenis_pengajuan',
        'nama_jenis_pengajuan',
        'kegiatan',
        'sub_kegiatan',
        'pekerjaan',
        'kode_rekening_belanja',
        'nama_rekening_belanja',
        'sumber_dana',
        'nomor_sp_spk',
        'lokasi',
        'nomor_spm',
        'tanggal_spm',
        'nominal',
        'nama_pihak_ketiga',
        'kualifikasi',
        'nomor_rekening',
        'nama_bank',
        'jangka_kontrak',
        'tanggal_mulai_pekerjaan',
        'tanggal_selesai_pekerjaan',
        'bpdp_filename',
        'bpdp_disk',
        'bpdp_folder',
        'bpdp_path',
        'bulan',
        'jenis_belanja',
        'jenis_pembayaran',
        'keterangan',
        'nip_pa_kpa',
        'nama_pa_kpa',
        'jabatan_pa_kpa',
        'nip_ppk',
        'nama_ppk',
        'jabatan_ppk',

        'status',
        'tanggal_pengajuan_verifikasi',

        'tanggal_verifikasi',
        'id_verifikator',
        'nama_verifikator',
        'catatan_verifikator',

        'tanggal_validasi',
        'id_validator',
        'nama_validator',
        'catatan_validator',

        'id_creator',
        'nama_creator',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) str()->uuid();
            }

            if (empty($model->id_creator) && empty($model->nama_creator)) {
                $model->id_creator = Auth::user()->id;
                $model->nama_creator = Auth::user()->name;
            }
        });
    }

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'id_skpd', 'id');
    }

    public function dokumen()
    {
        return $this->hasMany(PengajuanDokumen::class, 'id_pengajuan', 'id');
    }
}
