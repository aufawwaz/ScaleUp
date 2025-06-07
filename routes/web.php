<?php

use App\Http\Controllers\ContactController;
use App\http\Controllers\DashboardController;
use App\http\Controllers\SaldoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/transaction', function () {
    return view('transaction');
})->name('transaction');

// Saldo 
Route::get('/saldo', [SaldoController::class, 'index'])->name('saldo');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Product
Route::resource('product', ProductController::class)->parameters([
    'product' => 'product:slug'
]);

// Contact
Route::resource('contact', ContactController::class);

// News
Route::get('/news/fetch', [NewsController::class, 'fetchNewsHTML'])->name('news.fetch');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

// Authentication
Route::get('/login', function () 
    { return view('login');})->name('login');

Route::get('/register', function () 
    { return view('register'); })->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
