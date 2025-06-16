<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionHistoryController;

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


    Route::get('/storage/produk/{filename}', function ($filename) {
        $path = storage_path('app/public/produk/' . $filename);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->file($path, [
            'Content-Type' => mime_content_type($path)
        ]);
    });

    // Contact
    Route::resource('contact', ContactController::class);
    Route::get('/contact/getById/{id}', [ContactController::class, 'getById']);

    // News
    Route::get('/news/fetch', [NewsController::class, 'fetchNewsHTML'])->name('news.fetch');
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

    // Transaksi
    Route::get('/sale', [TransactionController::class, 'indexSale'])->name('sale');
    Route::get('/purchase', [TransactionController::class, 'indexPurchase'])->name('purchase');
    Route::get('/bill', [TransactionController::class, 'indexBill'])->name('bill');
    Route::get('/transaction/get-product', [TransactionController::class, 'getProductById'])->name('getProduct');
    Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/transaction/history', [TransactionHistoryController::class, 'index'])->name('transaction.history');
    Route::post('/transaction/markAsLunas/{id}', [App\Http\Controllers\TransactionController::class, 'markAsLunas'])->name('transaction.markAsLunas');
    Route::get('/autocomplete/contact', [ContactController::class, 'autocomplete'])->name('contact.autocomplete');
    Route::get('/autocomplete/saldo', [SaldoController::class, 'autocomplete'])->name('saldo.autocomplete');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
