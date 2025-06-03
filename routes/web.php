<?php

use App\http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/product', function () {
    return view('product');
})->name('product');

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