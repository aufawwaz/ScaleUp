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
                'nama_produk' => 'Kursi Kayu',
                'image' => 'kursi.jpg',
                'satuan' => 'pcs',
                'harga_jual' => 150000,
                'harga_modal' => 100000,
                'kategori' => 'Furniture',
                'deskripsi' => 'Kursi kayu minimalis untuk ruang tamu.',
                'stok' => 50,
            ],
            [
                'nama_produk' => 'Meja Belajar',
                'image' => 'meja.jpg',
                'satuan' => 'pcs',
                'harga_jual' => 250000,
                'harga_modal' => 180000,
                'kategori' => 'Furniture',
                'deskripsi' => 'Meja belajar anak dengan laci.',
                'stok' => 30,
            ],
            [
                'nama_produk' => 'Setrika Listrik',
                'image' => 'setrika.jpg',
                'satuan' => 'unit',
                'harga_jual' => 120000,
                'harga_modal' => 90000,
                'kategori' => 'Elektronik',
                'deskripsi' => 'Setrika listrik hemat energi.',
                'stok' => 40,
            ],
        ]);
    }
}
