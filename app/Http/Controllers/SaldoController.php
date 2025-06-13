<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SaldoController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Saldo::where('user_id', $request->user()->id)->get();
        return view('saldo.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validation($request);
        $validated['user_id'] = $request->user()->id;
        Saldo::create($validated);

        return redirect()->route('saldo.index')->with('success', 'Kartu berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $data = Saldo::all();
        $chartData = $this->getTransactionHistory($id);

        return view('saldo.index', compact($data, 'chartData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saldo $saldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validation($request);

        $data = Saldo::findOrFail($id);
        $data->update($validated);

        return redirect()->route('saldo.index')->with('success', 'Kartu berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Saldo::destroy($id);
        return redirect()->route('saldo.index')->with('success', 'Kartu berhasil dihapus!');
    }

    /**
     * Endpoint untuk auto-complete nama saldo
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('q', '');
        $userId = $request->user() ? $request->user()->id : null;
        $query = Saldo::query();
        if ($userId) {
            $query->where('user_id', $userId);
        }
        if ($search) {
            $query->where('nama', 'like', "%$search%");
        }
        $results = $query->limit(4)->get(['id', 'nama as label']);
        return response()->json($results);
    }

    private function validation(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'jenis' => 'required|in:Cash,Bank',
            'saldo' => 'nullable|numeric|min:1',
        ]);
        $validated['jenis'] = strtolower($validated['jenis']);
        $validated['saldo'] = $validated['saldo'] ?? "0";
        return $validated;
    }

    public function getTransactionHistory($id): JsonResponse
    {
        if ($id == -1) {
            // ambil dari database seluruh transaksi
        } else {
            // ambil dari database data transaksi yang menggunakan saldo tersebut
            // $data = Saldo::findOrFail($id);
        }
        Log::info('SaldoController: fetch [getTransactionHistory] request from: ' . $id);

        // responnya dummy data dulu
        return response()->json(collect([
            (object)[
                'tanggal' => '2025-05-22',
                'kode_transaksi' => 'TRSPJL22032025001',
                'jenis' => 'Pembelian',
                'status' => 'Lunas',
                'jumlah' => 90000
            ],
            (object)[
                'tanggal' => '2025-05-21',
                'kode_transaksi' => 'TRSPJL21032025001',
                'jenis' => 'Penjualan',
                'status' => 'Lunas',
                'jumlah' => 150000
            ],
            (object)[
                'tanggal' => '2025-05-20',
                'kode_transaksi' => 'TRSPJL20032025001',
                'jenis' => 'Tagihan',
                'status' => 'Lunas',
                'jumlah' => 50000
            ],
            (object)[
                'tanggal' => '2025-05-19',
                'kode_transaksi' => 'TRSPJL19032025001',
                'jenis' => 'Pembayaran',
                'status' => 'Pending',
                'jumlah' => 120000
            ],
            (object)[
                'tanggal' => '2025-05-18',
                'kode_transaksi' => 'TRSPJL18032025001',
                'jenis' => 'Pembelian',
                'status' => 'Lunas',
                'jumlah' => 200000
            ],
            (object)[
                'tanggal' => '2025-05-17',
                'kode_transaksi' => 'TRSPJL17032025001',
                'jenis' => 'Penjualan',
                'status' => 'Lunas',
                'jumlah' => 180000
            ],
            (object)[
                'tanggal' => '2025-05-16',
                'kode_transaksi' => 'TRSPJL16032025001',
                'jenis' => 'Tagihan',
                'status' => 'Belum Dibayar',
                'jumlah' => 30000
            ],
            (object)[
                'tanggal' => '2025-05-15',
                'kode_transaksi' => 'TRSPJL15032025001',
                'jenis' => 'Pembayaran',
                'status' => 'Lunas',
                'jumlah' => 95000
            ],
            (object)[
                'tanggal' => '2025-05-14',
                'kode_transaksi' => 'TRSPJL14032025001',
                'jenis' => 'Pembelian',
                'status' => 'Lunas',
                'jumlah' => 110000
            ],
            (object)[
                'tanggal' => '2025-05-13',
                'kode_transaksi' => 'TRSPJL13032025001',
                'jenis' => 'Penjualan',
                'status' => 'Pending',
                'jumlah' => 170000
            ],
        ]));
    }

    // Ambil saldo berdasarkan ID (API/JSON)
    public function getById($id): JsonResponse
    {
        $saldo = Saldo::find($id);
        if (!$saldo) {
            return response()->json(['error' => 'Saldo tidak ditemukan'], 404);
        }
        return response()->json($saldo);
    }
}
