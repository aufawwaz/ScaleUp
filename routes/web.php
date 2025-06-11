<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Profile
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Saldo
Route::get('saldo/fetch/{id}', [SaldoController::class, 'getTransactionHistory'])->name('saldo.fetch');
Route::resource('saldo', SaldoController::class);

// Product
Route::resource('product', ProductController::class)->parameters([
    'product' => 'product:slug',
    'backlink' => ''
]);

// Contact
Route::resource('contact', ContactController::class);

// News
Route::get('/news/fetch', [NewsController::class, 'fetchNewsHTML'])->name('news.fetch');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

// Transaksi
Route::get('/transaction', function () { return view('transaction'); })->name('transaction');
Route::get('/transaction/get-product', [TransactionController::class, 'getProductById'])->name('getProduct');
Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/sale', [TransactionController::class, 'indexSale'])->name('sale');
Route::get('/purchase', [TransactionController::class, 'indexPurchase']) ->name('purchase');
Route::get('/bill', [TransactionController::class, 'indexBill'])->name('bill');
Route::get('/autocomplete/contact', [ContactController::class, 'autocomplete'])->name('contact.autocomplete');
Route::get('/autocomplete/saldo', [SaldoController::class, 'autocomplete'])->name('saldo.autocomplete');

// Authentication
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect'])->name('google.redirect');
Route::get('/auth-google-callback', [AuthController::class, 'google_callback'])->name('google.callback');
