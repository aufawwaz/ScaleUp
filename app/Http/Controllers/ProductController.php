<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Tampilkan daftar produk
    public function index(Request $request)
    {
        $query = $request->user()->products(); // Mulai dari relasi user

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        if ($request->filter == 'kategori') {
            $query->orderBy('kategori');
        } elseif ($request->filter == 'satuan') {
            $query->orderBy('satuan');
        } elseif ($request->filter == 'stok') {
            $query->orderBy('stok', 'desc');
        }

        $products = $query->get(); // Ambil hasil query yang sudah difilter

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
            'stok'         => 'nullable|integer|min:0',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // Nilai null deskripsi
        $validated['deskripsi'] = $request->input('deskripsi', '-');
        $validated['stok'] = $request->input('stok', 0);

        // Handle upload gambar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('produk', 'public');
        }

        $request->user()->products()->create($validated);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Edit Produk
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    // Update Produk
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'satuan' => 'required|string',
            'harga_jual' => 'required|numeric',
            'harga_modal' => 'nullable|numeric',
            'kategori' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'stok' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:5128',
            'stok_change' => 'nullable|integer',
        ]);

        // Validasi nilai deskripsi
        $validated['deskripsi'] = $request->input('deskripsi', '-');

        // Kalkulasi stok
        $stok_change = (int) $request->input('stok_change', 0);
        $validated['stok'] = $product->stok + $stok_change;

        // Handle image upload jika ada file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('produk', 'public');
        }

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diupdate!');
    }

    // Hapus Produk
    public function destroy(Product $product)
    {
        // Hapus gambar jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus!');
    }

    // Show Detail Produk
    public function show(Product $product)
    {
        $backRoute = request('back');
        return view('product.show', compact('product', 'backRoute'));
    }

    public function addStock($id, $jumlah){
        $product = Product::findOrFail($id);
        $product->stok += $jumlah;
    }
}
