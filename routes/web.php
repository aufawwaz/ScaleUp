<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/transaction', function () {
    return view('transaction');
});

Route::get('/saldo', function () {
    return view('saldo');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/login', function () {
    return view('login');
});

