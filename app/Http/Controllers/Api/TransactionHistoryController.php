<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionHistoryController extends Controller
{
    // GET /api/transaction/history
    public function index(Request $request)
    {
        $transactions = Transaction::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $backRoute = $request->get('back', 'sale');
        return response()->json([
            'data' => $transactions,
            'back_route' => $backRoute
        ]);
    }
}
