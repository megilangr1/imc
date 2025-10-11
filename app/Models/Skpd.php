<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Skpd extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'kode_skpd',
        'nama_skpd',
        'kode_kelompok_skpd',
        'nama_kelompok_skpd',
        'tingkat',
        'id_creator',
        'nama_creator',
    ];


    protected $hidden = [
        'id',
        'id_creator',
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
}
