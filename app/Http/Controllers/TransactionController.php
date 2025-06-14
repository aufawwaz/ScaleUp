<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
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
        if ($pembayaran) {
            // Tidak perlu konversi 'cash' ke 'tunai', langsung gunakan value dari frontend
            $pembayaran = strtolower($pembayaran);
            // Validasi agar hanya enum yang valid
            $allowed = ['tunai', 'bank transfer', 'qris', 'kartu kredit', 'lainnya'];
            if (!in_array($pembayaran, $allowed)) {
                return response()->json(['success' => false, 'message' => 'Metode pembayaran tidak valid'], 422);
            }
        }

        // Generate custom id transaksi: KODEJENIS+DDMMYYYY+3digit_increment
        $kodeJenis = strtoupper($jenis) === 'SALE' ? 'PJL' : (strtoupper($jenis) === 'PURCHASE' ? 'PBL' : 'TGH');
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
                'tanggal' => $tanggal->format('Y-m-d'),
                'jenis' => $jenis,
                'kontak_id' => $kontakId,
                'saldo_id' => $saldoId,
                'nominal' => $nominal,
                'dibayar' => $dibayar,
            ];
            if (in_array($jenis, ['pembelian', 'tagihan']) && $status) {
                $dataTransaksi['status'] = $status;
            }
            if ($pembayaran && in_array($pembayaran, ['tunai', 'bank'])) {
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

                // PERUBAHAN DATA UNTUK PRODUCT SALDO DAN CONTACT 

                break; // sukses insert
            } catch (\Illuminate\Database\QueryException $e) {
                Log::error('QueryException insert transaksi', [
                    'error' => $e->getMessage(),
                    'sql' => $e->getSql(),
                    'bindings' => $e->getBindings(),
                    'data' => $dataTransaksi,
                    'request' => $request->all()
                ]);
                if ($e->getCode() == 23000) { // duplicate key
                    $newNumber++;
                    continue; // retry dengan id berikutnya
                } else {
                    return response()->json(['success' => false, 'message' => 'Gagal menyimpan transaksi', 'error' => $e->getMessage()], 500);
                }
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
        foreach ($pesanan as $item) {
            if (!isset($item['id'])) continue;
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item['id'],
                'jumlah' => $item['jumlah'],
            ]);

            // PERUBAHAN PRODUCT
            // app(ProductController::class)->addStock($product_id, $jumlah);
        }
        return response()->json(['success' => true, 'id' => $transaction->id]);
    }
}
