<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Penjualan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'nomor_nota',
        'nama_pekerjaan',
        'tempat_pekerjaan',
        'tanggal_pekerjaan',
        'pemilik_pekerjaan',
        'tanda_terima_pekerjaan',
        'total_nominal',

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

    public function detail()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_penjualan', 'id');
    }
}
