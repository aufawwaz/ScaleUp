<?php
namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = [
            (object)[
                'nama_produk' => 'Meja Belajar',
                'satuan' => 'Pcs',
                'harga_jual' => 1000000,
                'harga_modal' => 10000,
                'kategori' => 'Furniture',
                'deskripsi' => 'Meja belajar minimalis',
                'stok' => 100,
                'image' => null,
            ],
            (object)[
                'nama_produk' => 'Kursi Kantor',
                'satuan' => 'Pcs',
                'harga_jual' => 250000,
                'harga_modal' => 10000,
                'kategori' => 'Furniture',
                'deskripsi' => 'Kursi kantor ergonomis',
                'stok' => 50,
                'image' => null,
            ],
            (object)[
                'nama_produk' => 'Kursi Kantor',
                'satuan' => 'Pcs',
                'harga_jual' => 250000,
                'harga_modal' => 150000,
                'kategori' => 'Furniture',
                'deskripsi' => 'Kursi kantor ergonomis',
                'stok' => 50,
                'image' => null,
            ],
            (object)[
                'nama_produk' => 'Kursi Kantor',
                'satuan' => 'Pcs',
                'harga_jual' => 250000,
                'harga_modal' => 150000,
                'kategori' => 'Furniture',
                'deskripsi' => 'Kursi kantor ergonomis',
                'stok' => 50,
                'image' => null,
            ],
            (object)[
                'nama_produk' => 'Kursi Kantor',
                'satuan' => 'Pcs',
                'harga_jual' => 250000,
                'harga_modal' => 150000,
                'kategori' => 'Furniture',
                'deskripsi' => 'Kursi kantor ergonomis',
                'stok' => 50,
                'image' => null,
            ],
            (object)[
                'nama_produk' => 'Kursi Kantor',
                'satuan' => 'Pcs',
                'harga_jual' => 250000,
                'harga_modal' => 150000,
                'kategori' => 'Furniture',
                'deskripsi' => 'Kursi kantor ergonomis',
                'stok' => 50,
                'image' => null,
            ],
            (object)[
                'nama_produk' => 'Kursi Kantor',
                'satuan' => 'Pcs',
                'harga_jual' => 250000,
                'harga_modal' => 150000,
                'kategori' => 'Furniture',
                'deskripsi' => 'Kursi kantor ergonomis',
                'stok' => 50,
                'image' => null,
            ],
        ];

        return view('product', compact('products'));
    }
}
