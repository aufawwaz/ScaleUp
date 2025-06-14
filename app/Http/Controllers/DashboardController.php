<?php

namespace App\http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Saldo;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Contact;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index(Request $request)
  {
    $userId = Auth::id();

    // Jumlah saldo, produk, kontak milik user yang login
    $saldo = Saldo::where('user_id', $userId)->sum('saldo');
    $transaksi = Transaction::all()->count(); //belum dibedakan per user
    $kontak = Contact::where('user_id', $userId)->count();
    $produk = Product::where('user_id', $userId)->count();


    // Diagram donat
    $allTransaksi = Transaction::all();
    $labels = ['Tunai', 'Bank Transfer', 'Kredit', 'QRIS', 'Lainnya'];
    $data = [
      $allTransaksi->/**where('user_id', $userId)->*/where('jenis', '!=', 'pembelian')->where('status','!=', 'diproses')->where('status', '!=', 'jatuh tempo')->where('pembayaran', 'tunai')->sum('nominal'), 
      $allTransaksi->/**where('user_id', $userId)->*/where('jenis', '!=', 'pembelian')->where('status','!=', 'diproses')->where('status', '!=', 'jatuh tempo')->where('pembayaran', 'bank transfer')->sum('nominal'), 
      $allTransaksi->/**where('user_id', $userId)->*/where('jenis', '!=', 'pembelian')->where('status','!=', 'diproses')->where('status', '!=', 'jatuh tempo')->where('pembayaran', 'kartu kredit')->sum('nominal'), 
      $allTransaksi->/**where('user_id', $userId)->*/where('jenis', '!=', 'pembelian')->where('status','!=', 'diproses')->where('status', '!=', 'jatuh tempo')->where('pembayaran', 'qris')->sum('nominal'), 
      $allTransaksi->/**where('user_id', $userId)->*/where('jenis', '!=', 'pembelian')->where('status','!=', 'diproses')->where('status', '!=', 'jatuh tempo')->where('pembayaran', 'lainnya')->sum('nominal'), 
    ];
    $colors = ['#068EFF','#007AFF', '#1EACFF', '#83DFFF', '#D6F2FF'];
    $total = array_sum($data);

    $bulanIni = Carbon::now()->month;
    $bulanLalu = Carbon::now()->subMonth()->month;;
    $tahunIni = Carbon::now()->year;

    $totalBulanIni = Transaction::whereMonth('created_at', $bulanIni)
        ->whereYear('created_at', $tahunIni)
        ->where('jenis', '!=', 'pembelian')
        ->sum('nominal');

    $totalBulanLalu = Transaction::whereMonth('created_at', $bulanLalu)
        ->whereYear('created_at', $tahunIni)
        ->where('jenis', '!=', 'pembelian')
        ->sum('nominal');
        
    if ($totalBulanLalu > 0) {
        $percent = (($totalBulanIni - $totalBulanLalu) / $totalBulanLalu) * 100;
    } else {
        $percent = $totalBulanIni > 0 ? 100 : 0;
    }


    // Laba rugi
    $transaksiPembelian = Transaction::whereYear('created_at', $tahunIni)->where('jenis', 'pembelian');
    $transaksiPembelianBulanLalu = $transaksiPembelian->whereMonth('created_at', $bulanLalu);
    
    $profit = $total - $transaksiPembelian->sum('nominal');
    $profitBulanLalu = $totalBulanLalu - $transaksiPembelianBulanLalu->sum('nominal');

    if ($profitBulanLalu > 0) {
        $profitPercent = (($profit - $profitBulanLalu) / $profitBulanLalu) * 100;
    } else {
        $profitPercent = $profit > 0 ? 100 : 0;
    }


    // Pesanan terbaru
    $orders = Transaction::with(['kontak', 'items.product'])
        ->where('jenis', '!=', 'pembelian')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get()
        ->map(function($trx) {
            return [
                'customer' => $trx->kontak->nama_kontak ?? '-',
                'product' => $trx->items->first()->product->nama_produk ?? '-',
                'price' => $trx->nominal,
                'pembayaran' => ucfirst($trx->pembayaran ?? '-')
            ];
        })->toArray();


    // Pelanggan teratas (5 kontak dengan transaksi terbanyak, hitung dari transaksi)
    $topCustomers = \App\Models\Transaction::select('kontak_id', DB::raw('COUNT(*) as count'))
        ->whereNotNull('kontak_id')
        ->groupBy('kontak_id')
        ->orderByDesc('count')
        ->with('kontak')
        ->take(5)
        ->get()
        ->map(function($trx) {
            $kontak = $trx->kontak;
            return [
                'name' => $kontak->nama_kontak ?? '-',
                'avatar' => $kontak && $kontak->image_kontak ? asset('storage/'.$kontak->image_kontak) : ($kontak ? 'https://ui-avatars.com/api/?name='.urlencode($kontak->nama_kontak) : ''),
                'count' => $trx->count
            ];
        })->toArray();

    // Produk terlaris (5 produk dengan jumlah terjual terbanyak, hitung dari transaksi item)
    $topProducts = TransactionItem::select('product_id', DB::raw('SUM(jumlah) as sold'))
      ->whereHas('transaction', function($trx) {
          $trx->where('jenis', '!=', 'pembelian');
      })
      ->groupBy('product_id')
      ->orderByDesc('sold')
      ->with('product')
      ->take(5)
      ->get()
      ->map(function($item) {
        $product = $item->product;
        return [
          'name' => $product->nama_produk ?? '-',
          'avatar' => $product && $product->image_produk ? asset('storage/'.$product->image_produk) : ($product ? 'https://ui-avatars.com/api/?name='.urlencode($product->nama_produk) : ''),
          'sold' => $item->sold
        ];
      })->toArray();

    return view('dashboard', compact(
      // Dashboard card
      'saldo',
      'transaksi',
      'kontak',
      'produk',

      // Diagram donat
      'labels',
      'data',
      'colors',
      'total',
      'percent',
      'profit',
      'profitPercent',

      // Pesanan terbaru
      'orders',

      // Pelanggan teratas
      'topCustomers',

      // Produk terlaris
      'topProducts',
    ));
  }
}
