<?php

namespace App\http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Contact;

class DashboardController extends Controller
{
  public function index()
  {
    // Buat card dashboard
    $saldo = 9000000;
    $transaksi = 998;
    $kontak = Contact::count();
    $produk = Product::count();

    // Diagram donat
    $labels = ['Tunai', 'Kredit', 'QRIS', 'Lainnya'];
    $data = [1000000, 500000, 700000, 300000];
    $colors = ['#007AFF', '#1EACFF', '#83DFFF', '#D6F2FF'];
    $total = array_sum($data);
    $percent = 75;

    // Laba rugi
    $profit = 1000000;
    $profitPercent = 50;

    // Pesanan terbaru 
    $orders = [
      ['customer' => 'John Doe',    'product' => 'Meja',          'price' => 100000000, 'pembayaran' => 'QRIS'],
      ['customer' => 'Martin',      'product' => 'Kursi',         'price' => 10000000,  'pembayaran' => 'Tunai'],
      ['customer' => 'Christoper',  'product' => 'Sendok',        'price' => 20000,     'pembayaran' => 'Lainnya'],
      ['customer' => 'Aufa Fawwaz', 'product' => 'Kursi Belajar', 'price' => 5000000,   'pembayaran' => 'Kredit'],
      ['customer' => 'Ariel',       'product' => 'Cermin',        'price' => 30000,     'pembayaran' => 'Tunai'],
    ];

    // Pelanggan teratas
    $topCustomers = [
      ['name' => 'John Doe',        'avatar' => 'https://randomuser.me/api/portraits/men/1.jpg', 'count' => '5k'],
      ['name' => 'Ariel Josua',     'avatar' => 'https://randomuser.me/api/portraits/men/2.jpg', 'count' => '490'],
      ['name' => 'Uzumaki Boruto',  'avatar' => 'https://randomuser.me/api/portraits/men/3.jpg', 'count' => '30'],
      ['name' => 'Aldi Taher',      'avatar' => 'https://randomuser.me/api/portraits/men/4.jpg', 'count' => '5'],
    ];

    // Produk terlaris
    $topProducts = [
      ['name' => 'Kursi',   'avatar' => 'https://randomuser.me/api/portraits/men/1.jpg', 'sold' => '5k'],
      ['name' => 'Meja',    'avatar' => 'https://randomuser.me/api/portraits/men/1.jpg', 'sold' => '990'],
      ['name' => 'Setrika', 'avatar' => 'https://randomuser.me/api/portraits/men/1.jpg', 'sold' => '90'],
      ['name' => 'Kucing',  'avatar' => 'https://randomuser.me/api/portraits/men/1.jpg', 'sold' => '10'],
    ];

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
