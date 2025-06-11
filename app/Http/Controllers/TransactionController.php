<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class TransactionController extends Controller
{
    public function indexSale(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }
        $products = $request->user()->products()->get();

        return view('transaction', compact('products'));
    }
    
    public function indexPurchase(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }
        $products = $request->user()->products()->get();

        return view('transaction', compact('products'));
    }
    public function indexBill(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }
        $products = $request->user()->products()->get();

        return view('transaction', compact('products'));
    }

    public function getProductData($id){
        $data = Product::findOrFail($id);
        return $data->user()->products()->get();
    }
}
