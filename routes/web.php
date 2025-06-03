<?php

use App\http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/product', [ProductController::class, 'index'])->name('product');

Route::get('/transaction', function () {
    return view('transaction');
})->name('transaction');

Route::get('/saldo', function () {
    return view('saldo');
})->name('saldo');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/news', function () {
    return view('news');
})->name('news');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

// Product
Route::get('/product/create')->name('product.create');