<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Tampilkan daftar produk (GET /api/product)
    public function index(Request $request)
    {
        $query = $request->user()->products();

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

        $products = $query->get();

        return response()->json(['data' => $products]);
    }

    // Simpan produk baru (POST /api/product)
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

        $validated['deskripsi'] = $request->input('deskripsi', '-');
        $validated['stok'] = $request->input('stok', 0);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('produk', 'public');
        }

        $product = $request->user()->products()->create($validated);

        return response()->json(['message' => 'Produk berhasil ditambahkan!', 'data' => $product], 201);
    }

    // Detail produk (GET /api/product/{id})
    public function show(Request $request, $id)
    {
        $product = $request->user()->products()->findOrFail($id);
        return response()->json(['data' => $product]);
    }

    // Update produk (PUT/PATCH /api/product/{id})
    public function update(Request $request, $id)
    {
        $product = $request->user()->products()->findOrFail($id);

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

        $validated['deskripsi'] = $request->input('deskripsi', '-');

        // Kalkulasi stok jika ada perubahan
        $stok_change = (int) $request->input('stok_change', 0);
        $validated['stok'] = $product->stok + $stok_change;

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('produk', 'public');
        }

        $product->update($validated);

        return response()->json(['message' => 'Produk berhasil diupdate!', 'data' => $product]);
    }

    // Hapus produk (DELETE /api/product/{id})
    public function destroy(Request $request, $id)
    {
        $product = $request->user()->products()->findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return response()->json(['message' => 'Produk berhasil dihapus!']);
    }
}
