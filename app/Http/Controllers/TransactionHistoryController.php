<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::with(['items.product','kontak','saldo'])
            ->where('user_id', $request->user()->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $backRoute = $request->get('back', 'sale');
        return view('transaction.history', compact('transactions', 'backRoute'));
    }
}