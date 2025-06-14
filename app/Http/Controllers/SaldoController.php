<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Transaction;
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
        $today = now()->startOfDay();
        $days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $days->push($today->copy()->subDays($i)->format('Y-m-d'));
        }
        if ($id == -1) {
            $userId = auth()->user()->id;
            $saldoIds = Saldo::where('user_id', $userId)->pluck('id');
            $trx = Transaction::whereIn('saldo_id', $saldoIds)
                ->whereBetween('tanggal', [$days->first(), $days->last()])
                ->orderBy('tanggal')
                ->get();
            $saldoAwal = Saldo::whereIn('id', $saldoIds)->sum('saldo');
        } else {
            $trx = Transaction::where('saldo_id', $id)
                ->whereBetween('tanggal', [$days->first(), $days->last()])
                ->orderBy('tanggal')
                ->get();
            $saldoAwal = Saldo::find($id)?->saldo ?? 0;
        }
        // Hitung saldo berjalan mundur dari hari ini
        $trxByDate = $trx->groupBy('tanggal');
        $saldoPerHari = [];
        $saldo = $saldoAwal;
        // Loop dari hari terakhir ke hari pertama
        for ($i = 6; $i >= 0; $i--) {
            $date = $days[$i];
            $saldoPerHari[$i] = [
                'tanggal' => $date,
                'saldo' => $saldo
            ];
            $perubahan = 0;
            if (isset($trxByDate[$date])) {
                foreach ($trxByDate[$date] as $t) {
                    if (strtolower($t->jenis) === 'pembelian') {
                        $perubahan -= $t->nominal;
                    } else {
                        $perubahan += $t->nominal;
                    }
                }
            }
            $saldo -= $perubahan;
        }
        // Urutkan dari tanggal terlama ke terbaru
        ksort($saldoPerHari);
        $saldoPerHari = array_values($saldoPerHari);
        return response()->json($saldoPerHari);
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
