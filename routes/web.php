<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Route tanpa auth (login, register, google)
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect'])->name('google.redirect');
Route::get('/auth-google-callback', [AuthController::class, 'google_callback'])->name('google.callback');

// Route yang butuh login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/get', [ProfileController::class, 'getUserData']);

    // Saldo
    Route::get('saldo/fetch/{id}', [SaldoController::class, 'getTransactionHistory'])->name('saldo.fetch');
    Route::resource('saldo', SaldoController::class);
    Route::get('/saldo/getById/{id}', [SaldoController::class, 'getById']);

    // Product
    Route::resource('product', ProductController::class)->parameters([
        'product' => 'product:slug',
        'backlink' => ''
    ]);

    // Contact
    Route::resource('contact', ContactController::class);
    Route::get('/contact/getById/{id}', [ContactController::class, 'getById']);

    // News
    Route::get('/news/fetch', [NewsController::class, 'fetchNewsHTML'])->name('news.fetch');
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

    // Transaksi
    Route::get('transaction', [TransactionController::class, "getAllData"]);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
