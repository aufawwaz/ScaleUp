<?php

use App\http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/news', [NewsController::class, 'index'])->name('news');

Route::get('/transaction', function () {
    return view('transaction');
})->name('transaction');

Route::get('/saldo', function () {
    return view('saldo');
})->name('saldo');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

// Product
Route::resource('product', ProductController::class);

// Authentication
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
