<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Saldo;
use App\Models\Contact;
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

        $query = $user->products();

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        return $query->get();
    }

    public function getProductById($id)
    {
        $data = Product::findOrFail($id);
        return $data->user()->products()->get();
    }

    public function store(Request $request)
    {
        // 1. Validasi awal dengan pengecekan custom agar mudah debugging
        $validator = Validator::make($request->all(), [
            'kontak'     => 'required',
            'saldo'      => 'required',
            'jenis'      => 'required|string',
            'nominal'    => 'required|numeric',
            'pesanan'    => 'required|array|min:1',
            'pesanan.*.id'     => 'required|integer',
            'pesanan.*.jumlah' => 'nullable|integer|min:1',
            'dibayar'    => 'nullable|numeric',
            'pembayaran' => 'nullable|string',
            'status'     => 'nullable|string',
            'jatuh_tempo'=> 'nullable|date',
        ]);

        if ($validator->fails()) {
            Log::warning('Validasi store transaksi gagal', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'errors'  => $validator->errors()
            ], 422);
        }

        // 2. Cari ID kontak dan saldo
        $kontakInput = $request->input('kontak');
        $saldoInput  = $request->input('saldo');
        $kontakId = null;
        $saldoId  = null;

        if (is_numeric($kontakInput)) {
            $kontakId = (int)$kontakInput;
        } else {
            $kontakModel = Contact::where('nama_kontak', $kontakInput)->first();
            if ($kontakModel) {
                $kontakId = $kontakModel->id;
            }
        }
        if (is_numeric($saldoInput)) {
            $saldoId = (int)$saldoInput;
        } else {
            $saldoModel = Saldo::where('nama', $saldoInput)->first();
            if ($saldoModel) {
                $saldoId = $saldoModel->id;
            }
        }
        if (!$kontakId || !$saldoId) {
            Log::warning('Kontak atau saldo tidak valid', [
                'kontakInput' => $kontakInput,
                'saldoInput'  => $saldoInput,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Kontak atau saldo tidak valid'
            ], 422);
        }

        // 3. Konversi jenis
        $jenisInput = $request->input('jenis');
        $jenis = null;
        if ($jenisInput === 'sale' || strtolower($jenisInput) === 'penjualan') {
            $jenis = 'penjualan';
        } elseif ($jenisInput === 'purchase' || strtolower($jenisInput) === 'pembelian') {
            $jenis = 'pembelian';
        } elseif ($jenisInput === 'bill' || strtolower($jenisInput) === 'tagihan') {
            $jenis = 'tagihan';
        } else {
            Log::warning('Jenis transaksi tidak valid', ['jenisInput' => $jenisInput]);
            return response()->json([
                'success' => false,
                'message' => 'Jenis transaksi tidak valid'
            ], 422);
        }

        $nominal    = (float) $request->input('nominal');
        $dibayar    = $request->input('dibayar') !== null ? (float)$request->input('dibayar') : null;
        $pembayaran = $request->input('pembayaran');
        $status     = $request->input('status');
        $jatuhTempo = $request->input('jatuh_tempo');
        $pesanan    = $request->input('pesanan');

        // 4. Konversi pembayaran jika ada
        if ($pembayaran !== null && $pembayaran !== '') {
            $pembayaranLower = strtolower($pembayaran);
            $allowed = ['tunai', 'bank transfer', 'qris', 'kartu kredit', 'lainnya'];
            if (!in_array($pembayaranLower, $allowed)) {
                Log::warning('Metode pembayaran tidak valid', ['pembayaran' => $pembayaran]);
                return response()->json([
                    'success' => false,
                    'message' => 'Metode pembayaran tidak valid'
                ], 422);
            }
            $pembayaran = $pembayaranLower;
        } else {
            $pembayaran = null;
        }

        // Pengecekan stok sebelum DB transaction
        if (in_array($jenis, ['penjualan', 'tagihan'])) {
            $stokInsufficient = [];
            foreach ($pesanan as $item) {
                $productId = $item['id'];
                $jumlah     = isset($item['jumlah']) ? (int)$item['jumlah'] : 1;
                $product    = Product::find($productId);

                if (!$product) {
                    $stokInsufficient[] = [
                        'product_id'     => $productId,
                        'nama_produk'    => 'Unknown (ID ' . $productId . ')',
                        'stok_tersedia'  => 0,
                        'diminta'        => $jumlah,
                    ];
                } else {
                    if ($product->stok < $jumlah) {
                        $stokInsufficient[] = [
                            'product_id'     => $productId,
                            'nama_produk'    => $product->nama_produk,
                            'stok_tersedia'  => $product->stok,
                            'diminta'        => $jumlah,
                        ];
                    }
                }
            }
            if (!empty($stokInsufficient)) {
                Log::warning('Stok tidak cukup untuk beberapa produk', ['detail' => $stokInsufficient]);
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak cukup untuk beberapa produk',
                    'errors'  => [
                        'stok' => $stokInsufficient
                    ]
                ], 422);
            }
        }

        // 5. Siapkan ID transaksi custom: KODE + DDMMYYYY + 3 digit
        $tanggal = now();
        $tanggalStr = $tanggal->format('dmY');
        $kodeJenis = $jenis === 'penjualan' ? 'PJL'
                   : ($jenis === 'pembelian' ? 'PBL' : 'TGH');
        $prefix = $kodeJenis . $tanggalStr;
        $maxRetry = 10;
        $transactionId = null;

        // 6. Ambil saldo awal
        $saldoModel = Saldo::find($saldoId);
        if (!$saldoModel) {
            Log::error('Saldo tidak ditemukan di DB setelah validasi', ['saldoId'=>$saldoId]);
            return response()->json([
                'success' => false,
                'message' => 'Saldo tidak ditemukan'
            ], 422);
        }
        $saldoAwal = (float) $saldoModel->saldo;

        // 7. Pakai DB transaction agar atomic
        DB::beginTransaction();
        try {
            // Generate ID transaksi
            for ($i = 1; $i <= $maxRetry; $i++) {
                $candidateId = $prefix . str_pad($i, 3, '0', STR_PAD_LEFT);
                $exists = Transaction::where('id', $candidateId)->exists();
                if (!$exists) {
                    $transactionId = $candidateId;
                    break;
                }
            }
            if (!$transactionId) {
                Log::error('Gagal generate ID transaksi unik setelah retry', ['prefix'=>$prefix]);
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal membuat ID transaksi, silakan coba lagi.'
                ], 500);
            }

            // Bangun data untuk insert transaksi
            $dataTransaksi = [
                'id'         => $transactionId,
                'tanggal'    => $tanggal,
                'jenis'      => $jenis,
                'kontak_id'  => $kontakId,
                'saldo_id'   => $saldoId,
                'nominal'    => $nominal,
                'user_id'    => $request->user()->id,
            ];
            if (in_array($jenis, ['pembelian', 'tagihan']) && $status) {
                $statusLower = strtolower($status);
                $allowedStatus = ['lunas', 'diproses', 'jatuh tempo'];
                if (!in_array($statusLower, $allowedStatus)) {
                    Log::warning('Status transaksi tidak valid', ['status'=>$status]);
                    return response()->json([
                        'success' => false,
                        'message' => 'Status transaksi tidak valid'
                    ], 422);
                }
                $dataTransaksi['status'] = $statusLower;
            }
            if ($pembayaran) {
                $dataTransaksi['pembayaran'] = $pembayaran;
            }
            if ($jatuhTempo) {
                $dataTransaksi['jatuh_tempo'] = $jatuhTempo;
            }
            $dataTransaksi['dibayar'] = $dibayar !== null ? $dibayar : $nominal;

            // Buat Transaction
            $transaction = Transaction::create($dataTransaksi);
            if (!$transaction) {
                Log::error('Eloquent create Transaction mengembalikan null', ['data'=>$dataTransaksi]);
                throw new \Exception('Gagal membuat transaksi');
            }

            // Proses setiap item
            foreach ($pesanan as $item) {
                $productId = $item['id'];
                $jumlah = isset($item['jumlah']) ? (int)$item['jumlah'] : 1;

                $product = Product::find($productId);
                if (!$product) {
                    Log::warning('Product tidak ditemukan di DB', ['productId'=>$productId]);
                    throw new \Exception("Produk dengan ID {$productId} tidak ditemukan");
                }

                if ($jenis === 'pembelian') {
                    $product->stok += $jumlah;
                    $product->save();
                } else {
                    // Stok sudah dicek sebelumnya, tapi cek ulang jika perlu
                    if ($product->stok < $jumlah) {
                        Log::warning('Stok produk tidak cukup pada saat processing', [
                            'productId'=>$productId,
                            'stokSaatIni'=>$product->stok,
                            'diminta'=>$jumlah,
                        ]);
                        DB::rollBack();
                        return response()->json([
                            'success' => false,
                            'message' => 'Produk habis atau stok tidak cukup: ' . $product->nama_produk
                        ], 422);
                    }
                    $product->stok -= $jumlah;
                    $product->save();
                }

                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id'     => $productId,
                    'jumlah'         => $jumlah,
                ]);
            }

            // Update saldo
            $saldoModel->refresh();
            $saldoSekarang = (float)$saldoModel->saldo;
            if ($jenis === 'penjualan') {
                $saldoModel->saldo = $saldoSekarang + $nominal;
                $saldoModel->save();
            } elseif ($jenis === 'pembelian') {
                if ($saldoSekarang < $nominal) {
                    Log::warning('Saldo tidak cukup untuk pembelian setelah item diproses', [
                        'saldoSekarang'=>$saldoSekarang,
                        'nominal'=>$nominal,
                    ]);
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'Saldo tidak cukup'
                    ], 422);
                }
                $saldoModel->saldo = $saldoSekarang - $nominal;
                $saldoModel->save();
            } elseif ($jenis === 'tagihan') {
                if (!empty($dataTransaksi['status']) && $dataTransaksi['status'] === 'lunas') {
                    $saldoModel->saldo = $saldoSekarang + $nominal;
                    $saldoModel->save();
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'id'      => $transaction->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Exception di store transaksi', [
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
                'request' => $request->all(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Internal server error',
                'error'   => $e->getMessage()
            ], 500);
        }
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
            $trx->status = 'lunas';
            $trx->save();
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
}