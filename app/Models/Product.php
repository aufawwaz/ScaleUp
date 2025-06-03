<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];
}
