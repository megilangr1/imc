<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PengajuanDokumen extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'id_pengajuan',

        'kode_jenis_dokumen',
        'nama_jenis_dokumen',

        'disk',
        'folder',
        'filename',
        'path',

        'status_verifikasi',
        'id_verifikator',
        'nama_verifikator',

        'status_validasi',
        'id_validator',
        'nama_validator',

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

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'id_pengajuan', 'id');
    }
}
