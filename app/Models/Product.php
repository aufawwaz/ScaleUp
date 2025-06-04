<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'nama_produk',
        'image',
        'satuan',
        'harga_jual',
        'harga_modal',
        'kategori',
        'deskripsi',
        'stok',
        'slug',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->nama_produk);
        });
        static::updating(function ($product) {
            $product->slug = Str::slug($product->nama_produk);
        });
    }
}
