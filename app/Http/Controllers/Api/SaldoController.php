<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Saldo;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    // GET /api/saldo
    public function index(Request $request)
    {
        $data = Saldo::where('user_id', $request->user()->id)->get();
        return response()->json(['data' => $data]);
    }

    // POST /api/saldo
    public function store(Request $request)
    {
        $validated = $this->validation($request);
        $validated['user_id'] = $request->user()->id;
        $saldo = Saldo::create($validated);

        return response()->json(['message' => 'Kartu berhasil ditambah!', 'data' => $saldo], 201);
    }

    // GET /api/saldo/{id}
    public function show(Request $request, $id)
    {
        $saldo = Saldo::where('user_id', $request->user()->id)->findOrFail($id);
        return response()->json(['data' => $saldo]);
    }

    // PUT/PATCH /api/saldo/{id}
    public function update(Request $request, $id)
    {
        $validated = $this->validation($request);
        $saldo = Saldo::where('user_id', $request->user()->id)->findOrFail($id);
        $saldo->update($validated);

        return response()->json(['message' => 'Kartu berhasil diubah!', 'data' => $saldo]);
    }

    // DELETE /api/saldo/{id}
    public function destroy(Request $request, $id)
    {
        $saldo = Saldo::where('user_id', $request->user()->id)->findOrFail($id);
        $saldo->delete();
        return response()->json(['message' => 'Kartu berhasil dihapus!']);
    }

    // GET /api/saldo/autocomplete?q=...
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

    // GET /api/saldo/{id}/history
    public function getTransactionHistory(Request $request, $id)
    {
        $today = now()->startOfDay();
        $days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $days->push($today->copy()->subDays($i)->format('Y-m-d'));
        }
        if ($id == -1) {
            $userId = $request->user()->id;
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
        $trxByDate = $trx->groupBy('tanggal');
        $saldoPerHari = [];
        $saldo = $saldoAwal;
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
        ksort($saldoPerHari);
        $saldoPerHari = array_values($saldoPerHari);
        return response()->json($saldoPerHari);
    }

    // Validation helper
    private function validation(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'jenis' => 'required|in:cash,bank',
            'saldo' => 'nullable|numeric|min:1',
        ]);
        $validated['jenis'] = strtolower($validated['jenis']);
        $validated['saldo'] = $validated['saldo'] ?? "0";
        return $validated;
    }
}
