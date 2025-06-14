<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionHistoryController extends Controller
{
    public function index(Request $request){

        $transaction = Transaction::orderBy('created_at', 'desc')->get();
        $backRoute = $request->get('back', 'sale');
        return view('transaction.history', compact(['transaction', 'backRoute']));
    }
}
