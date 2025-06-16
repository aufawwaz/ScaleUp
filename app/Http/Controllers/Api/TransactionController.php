<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Saldo;
use App\Models\Contact;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    // GET /api/sale
    public function indexSale(Request $request)
    {
        $user = $request->user();
        $transactions = Transaction::where('user_id', $user->id)
            ->where('jenis', 'penjualan')
            ->with(['kontak', 'saldo', 'items.product'])
            ->orderByDesc('tanggal')
            ->get();

        return response()->json(['data' => $transactions]);
    }

    // GET /api/purchase
    public function indexPurchase(Request $request)
    {
        $user = $request->user();
        $transactions = Transaction::where('user_id', $user->id)
            ->where('jenis', 'pembelian')
            ->with(['kontak', 'saldo', 'items.product'])
            ->orderByDesc('tanggal')
            ->get();

        return response()->json(['data' => $transactions]);
    }

    // GET /api/bill
    public function indexBill(Request $request)
    {
        $user = $request->user();
        $transactions = Transaction::where('user_id', $user->id)
            ->where('jenis', 'tagihan')
            ->with(['kontak', 'saldo', 'items.product'])
            ->orderByDesc('tanggal')
            ->get();

        return response()->json(['data' => $transactions]);
    }

    // GET /api/transaction/product/{id}
    public function getProductById(Request $request, $id)
    {
        $user = $request->user();
        $product = Product::where('user_id', $user->id)->findOrFail($id);
        return response()->json(['data' => $product]);
    }

    // POST /api/transaction
    public function store(Request $request)
    {
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
        $kontakId = is_numeric($kontakInput)
            ? $kontakInput
            : Contact::where('nama_kontak', $kontakInput)->value('id');
        $saldoId = is_numeric($saldoInput)
            ? $saldoInput
            : Saldo::where('nama', $saldoInput)->value('id');

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

        // Generate custom id transaksi
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
            if (Transaction::where('id', $id)->exists()) {
                $newNumber++;
                continue;
            }
            $dataTransaksi = [
                'id' => $id,
                'tanggal' => $tanggal->format('Y-m-d H:i'),
                'jenis' => $jenis,
                'kontak_id' => $kontakId,
                'saldo_id' => $saldoId,
                'nominal' => $nominal,
                'dibayar' => $dibayar ?? $nominal,
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
            try {
                $transaction = Transaction::create($dataTransaksi);
                break;
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
                    if ($product->stok < $jumlah) {
                        return response()->json(['success' => false, 'message' => 'Produk habis: ' . $product->nama_produk], 422);
                    }
                    $product->stok -= $jumlah;
                    $product->save();
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

    // POST /api/transaction/{id}/markAsLunas
    public function markAsLunas(Request $request, $id)
    {
        try {
            $trx = Transaction::where('user_id', $request->user()->id)->findOrFail($id);
            if ($trx->jenis !== 'tagihan') {
                return response()->json(['success' => false, 'message' => 'Bukan transaksi tagihan'], 422);
            }
            if ($trx->status === 'lunas') {
                return response()->json(['success' => false, 'message' => 'Sudah lunas'], 422);
            }
            $trx->status = 'lunas';
            $trx->save();
            $saldo = Saldo::find($trx->saldo_id);
            if ($saldo) {
                $saldo->saldo = ((float)$saldo->saldo) + ((float)$trx->nominal);
                $saldo->save();
            }
            return response()->json(['success' => true, 'message' => 'Tagihan berhasil dilunasi']);
        } catch (\Exception $e) {
            Log::error('Mark as lunas error', ['error' => $e->getMessage(), 'id' => $id]);
            return response()->json(['success' => false, 'message' => 'Gagal update status', 'error' => $e->getMessage()], 500);
        }
    }

    public function getAllData()
    {
        return response()->json([
            'success' => true,
            'data' => Transaction::all()
        ]);
    }
}
