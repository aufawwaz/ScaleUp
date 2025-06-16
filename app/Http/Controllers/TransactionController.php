<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Saldo;
use Illuminate\Support\Facades\Log;
use App\Models\Transaction;
use App\Models\TransactionItem;

class TransactionController extends Controller
{
    public function indexSale(Request $request)
    {
        $products = $this->getProducts($request);
        $title = 'Penjualan';

        return view('transaction.index', compact('products', 'title'));
    }

    public function indexPurchase(Request $request)
    {
        $products = $this->getProducts($request);
        $title = 'Pembelian';

        return view('transaction.index', compact('products', 'title'));
    }
    public function indexBill(Request $request)
    {
        $products = $this->getProducts($request);
        $title = 'Tagihan';

        return view('transaction.index', compact('products', 'title'));
    }

    public function getProducts(Request $request, $filter = 'filter isnt implemented')
    {
        $user = $request->user();
        if (!$user) return collect([]);

        $query = $user->products(); // Mulai dari relasi user

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Tambahkan filter lain jika perlu

        return $query->get(); // Ambil hasil query yang sudah difilter
    }

    public function getProductById($id)
    {
        $data = Product::findOrFail($id);
        return $data->user()->products()->get();
    }
    public function store(Request $request)
    {
        // Debug: log request input untuk troubleshooting
        $request->validate([
            'kontak' => 'required',
            'saldo' => 'required',
            'jenis' => 'required',
            'nominal' => 'required|numeric',
            'pesanan' => 'required|array',
            'dibayar' => 'nullable|numeric',
        ]);

        // Cari ID kontak dan saldo dari label jika input bukan id
        $kontakInput = $request->input('kontak');
        $saldoInput = $request->input('saldo');
        $kontakId = null;
        $saldoId = null;
        // Kontak: jika numeric, langsung id, jika string, cari by nama_kontak
        if (is_numeric($kontakInput)) {
            $kontakId = $kontakInput;
        } else {
            $kontak = \App\Models\Contact::where('nama_kontak', $kontakInput)->first();
            if ($kontak) $kontakId = $kontak->id;
        }
        // Saldo: jika numeric, langsung id, jika string, cari by nama
        if (is_numeric($saldoInput)) {
            $saldoId = $saldoInput;
        } else {
            $saldo = \App\Models\Saldo::where('nama', $saldoInput)->first();
            if ($saldo) $saldoId = $saldo->id;
        }
        if (!$kontakId || !$saldoId) {
            return response()->json(['success' => false, 'message' => 'Kontak atau saldo tidak valid'], 422);
        }
        $jenis = $request->input('jenis');
        $nominal = $request->input('nominal');
        $status = $request->input('status');
        $jatuhTempo = $request->input('jatuh_tempo');
        $pembayaran = $request->input('pembayaran');
        $pesanan = $request->input('pesanan');
        $dibayar = $request->input('dibayar');

        // Konversi jenis agar sesuai enum DB
        if ($jenis === 'sale') $jenis = 'penjualan';
        elseif ($jenis === 'purchase') $jenis = 'pembelian';
        elseif ($jenis === 'bill') $jenis = 'tagihan';

        // Konversi pembayaran agar sesuai enum DB
        if ($pembayaran !== null && $pembayaran !== '') {
            $pembayaran = strtolower($pembayaran);
            $allowed = ['tunai', 'bank transfer', 'qris', 'kartu kredit', 'lainnya'];
            if (!in_array($pembayaran, $allowed)) {
                return response()->json(['success' => false, 'message' => 'Metode pembayaran tidak valid'], 422);
            }
        } else {
            $pembayaran = null;
        }

        // Generate custom id transaksi: KODEJENIS+DDMMYYYY+3digit_increment
        $kodeJenis = strtoupper($jenis) === 'PENJUALAN' ? 'PJL'
            : (strtoupper($jenis) === 'PEMBELIAN' ? 'PBL'
                : 'TGH');
        $tanggal = now();
        $tanggalStr = $tanggal->format('dmY');
        $prefix = $kodeJenis . $tanggalStr;
        $maxRetry = 10;
        $transaction = null;
        $newNumber = 1;
        for ($i = 0; $i < $maxRetry; $i++) {
            $id = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            // Cek apakah id sudah ada di database
            if (Transaction::where('id', $id)->exists()) {
                $newNumber++;
                continue;
            }
            // Build data transaksi hanya dengan field yang valid
            $dataTransaksi = [
                'id' => $id,
                'tanggal' => $tanggal->format('Y-m-d H:i'), // Simpan tanggal + jam:menit
                'jenis' => $jenis,
                'kontak_id' => $kontakId,
                'saldo_id' => $saldoId,
                'nominal' => $nominal,
                'dibayar' => $dibayar,
                'user_id' => $request->user()->id,
            ];
            if (in_array($jenis, ['pembelian', 'tagihan']) && $status) {
                $dataTransaksi['status'] = $status;
            }
            if ($pembayaran !== null) {
                $dataTransaksi['pembayaran'] = $pembayaran;
            }
            if ($jatuhTempo) {
                $dataTransaksi['jatuh_tempo'] = $jatuhTempo;
            }
            if ($dibayar) {
                $dataTransaksi['dibayar'] = $dibayar;
            } else {
                $dataTransaksi['dibayar'] = $nominal;
            }
            try {
                $transaction = Transaction::create($dataTransaksi);
                break; // Stop loop setelah berhasil insert satu transaksi
            } catch (\Illuminate\Database\QueryException $e) {
                Log::error('QueryException insert transaksi', [
                    'error' => $e->getMessage(),
                    'sql' => $e->getSql(),
                    'bindings' => $e->getBindings(),
                    'data' => $dataTransaksi,
                    'request' => $request->all()
                ]);
                return response()->json(['success' => false, 'message' => 'Gagal menyimpan transaksi', 'error' => $e->getMessage()], 500);
            }
        }
        if (!$transaction) {
            Log::error('Gagal insert transaksi setelah retry', ['request' => $request->all()]);
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan transaksi, silakan coba lagi.'], 500);
        }
        // Pastikan $transaction adalah instance valid sebelum insert item
        if (!$transaction->id) {
            Log::error('Transaksi tidak memiliki id setelah insert', ['transaction' => $transaction]);
            return response()->json(['success' => false, 'message' => 'Transaksi gagal dibuat.'], 500);
        }
        // Proses item dan saldo
        try {
            $saldo = Saldo::findOrFail($saldoId);
            $saldoNominal = (float) ($saldo->saldo ?? 0);
            $nominalFloat = (float) ($nominal ?? 0);
            foreach ($pesanan as $item) {
                if (!isset($item['id'])) continue;
                $jumlah = isset($item['jumlah']) ? (int)$item['jumlah'] : 1;
                $product = Product::findOrFail($item['id']);
                if ($jenis === 'pembelian') {
                    $product->stok += $jumlah;
                    $product->save();
                } else {
                    // Penjualan/tagihan: cek stok, kurangi stok, tambah saldo
                    if ($product->stok < $jumlah) {
                        return response()->json(['success' => false, 'message' => 'Produk habis: ' . $product->nama_produk], 422);
                    }
                    $product->stok -= $jumlah;
                    $product->save();
                    // Penambahan saldo hanya jika bukan tagihan BELUM lunas
                    if ($jenis === 'penjualan' || ($jenis === 'tagihan' && $status === 'lunas')) {
                        $saldo->saldo = $saldoNominal + $nominalFloat;
                        $saldo->save();
                    }
                }
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['id'],
                    'jumlah' => $jumlah,
                ]);
            }
            // Update saldo hanya sekali per transaksi
            if ($jenis === 'pembelian') {
                if ($saldoNominal < $nominalFloat) {
                    return response()->json(['success' => false, 'message' => 'Saldo tidak cukup'], 422);
                }
                $saldo->saldo = $saldoNominal - $nominalFloat;
                $saldo->save();
            }
        } catch (\Throwable $e) {
            Log::error('Transaction store error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            return response()->json(['success' => false, 'message' => 'Internal server error', 'error' => $e->getMessage()], 500);
        }
        return response()->json(['success' => true, 'id' => $transaction->id]);
    }

    public function markAsLunas($id)
    {
        try {
            $trx = Transaction::findOrFail($id);
            if ($trx->jenis !== 'tagihan') {
                return back()->with('error', 'Bukan transaksi tagihan');
            }
            if ($trx->status === 'lunas') {
                return back()->with('error', 'Sudah lunas');
            }
            // Update status
            $trx->status = 'lunas';
            $trx->save();
            // Tambah saldo
            $saldo = Saldo::find($trx->saldo_id);
            if ($saldo) {
                $saldo->saldo = ((float)$saldo->saldo) + ((float)$trx->nominal);
                $saldo->save();
            }
            return redirect()->back()->with('success', 'Tagihan berhasil dilunasi');
        } catch (\Exception $e) {
            Log::error('Mark as lunas error', ['error' => $e->getMessage(), 'id' => $id]);
            return back()->with('error', 'Gagal update status');
        }
    }
    public function getAllData(){
        return response()->json([
            'success' => true,
            'data' => Transaction::all()
        ]);
    }
}
