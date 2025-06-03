<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Tampilkan daftar produk
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filter == 'kategori') {
            $query->orderBy('kategori');
        } elseif ($request->filter == 'satuan') {
            $query->orderBy('satuan');
        } elseif ($request->filter == 'stok') {
            $query->orderBy('stok', 'desc');
        }

        $products = $query->get();

        return view('product.index', compact('products'));
    }

    // Tampilkan form tambah produk
    public function create()
    {
        return view('product.create');
    }

    // Simpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk'  => 'required|string|max:255',
            'satuan'       => 'required|string|max:50',
            'harga_jual'   => 'required|integer',
            'harga_modal'  => 'nullable|integer',
            'kategori'     => 'nullable|string|max:100',
            'deskripsi'    => 'nullable|string',
            'stok'         => 'nullable|integer',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle upload gambar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('produk', 'public');
        }

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan!');
    }
}
