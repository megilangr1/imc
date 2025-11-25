<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Produk extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'id_kategori',
        'nama_produk',
        'slug_produk',

        'sku',
        'brand',

        'harga',
        'stok',
        'satuan',

        'deskripsi',

        'disk',
        'folder',
        'filename',
        'path',

        'published',
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

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}
