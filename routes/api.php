<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\SaldoController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TransactionHistoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth (API login/register biasanya pakai Sanctum/Passport)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Route yang butuh autentikasi token
Route::middleware('auth:sanctum')->group(function () {
    //     // Dashboard (opsional, jika ada endpoint summary)
    //     // Route::get('/dashboard', [DashboardController::class, 'index']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile', [ProfileController::class, 'update']);

    // Saldo
    Route::get('/saldo/{id}/history', [SaldoController::class, 'getTransactionHistory']);
    Route::apiResource('saldo', SaldoController::class);
    Route::get('/saldo/{id}', [SaldoController::class, 'show']);

    // Product
    Route::apiResource('product', ProductController::class);

    // Contact
    Route::apiResource('contact', ContactController::class);
    Route::get('/contact/{id}', [ContactController::class, 'show']);

    //     // // News
    //     // Route::get('/news', [NewsController::class, 'index']);
    //     // Route::get('/news/{id}', [NewsController::class, 'show']);

    // Transaksi
    Route::get('/sale', [TransactionController::class, 'indexSale']);
    Route::get('/purchase', [TransactionController::class, 'indexPurchase']);
    Route::get('/bill', [TransactionController::class, 'indexBill']);
    Route::get('/transaction/product/{id}', [TransactionController::class, 'getProductById']);
    Route::post('/transaction', [TransactionController::class, 'store']);
    Route::get('/transaction/history', [TransactionHistoryController::class, 'index']);
    Route::post('/transaction/{id}/markAsLunas', [TransactionController::class, 'markAsLunas']);

    //Autocomplete
    Route::get('/autocomplete/contact', [ContactController::class, 'autocomplete']);
    Route::get('/autocomplete/saldo', [SaldoController::class, 'autocomplete']);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
