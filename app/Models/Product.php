<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_produk',
        'image',      // Nama produk
        'satuan',           // Satuan
        'harga_jual',       // Harga jual
        'harga_modal',      // Harga modal
        'kategori',         // Kategori
        'deskripsi',        // Deskripsi produk
        'stok',        // Stok awal
    ];
}
