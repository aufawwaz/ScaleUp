<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'nama_produk' => 'Komik Naruto',
                'image' => 'produk\naruto.jpg',
                'satuan' => 'pcs',
                'harga_jual' => 150000,
                'harga_modal' => 100000,
                'kategori' => 'Barang',
                'deskripsi' => 'Komik Naruto',
                'stok' => 50,
                'slug' => 'komik-naruto',
            ],
            [
                'nama_produk' => 'Komik One Piece',
                'image' => 'produk\onepiece.jpg',
                'satuan' => 'pcs',
                'harga_jual' => 250000,
                'harga_modal' => 180000,
                'kategori' => 'Barang',
                'deskripsi' => 'Komik One Piece',
                'stok' => 30,
                'slug' => 'komik-one-piece',
            ],
            [
                'nama_produk' => 'Komik Solo Leveling',
                'image' => 'produk\solev.png',
                'satuan' => 'pcs',
                'harga_jual' => 120000,
                'harga_modal' => 90000,
                'kategori' => 'Barang',
                'deskripsi' => 'Komik Solo Leveling',
                'stok' => 40,
                'slug' => 'komik-solo-leveling',
            ],
            [
                'nama_produk' => 'Komik Tomb Raider King',
                'image' => 'produk\tomb_raider.jpg',
                'satuan' => 'pcs',
                'harga_jual' => 120000,
                'harga_modal' => 90000,
                'kategori' => 'Barang',
                'deskripsi' => 'Komik Tomb Raider King',
                'stok' => 40,
                'slug' => 'komik-tomb-raider-king',
            ],
        ]);
    }
}
