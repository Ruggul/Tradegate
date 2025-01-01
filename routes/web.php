<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserCartManagement\CartController;
use App\Http\Controllers\adminControllers\AdminController;
use App\Http\Controllers\adminControllers\AdminLogController;

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Basic Pages
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/products', function () {
    return view('pages.products');
})->name('products');

Route::get('/privacy-policy', function () {
    return view('pages.privacy');
})->name('privacy-policy');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    // Admin Account Management
    Route::resource('accounts', AdminController::class);
    Route::patch('accounts/{admin}/toggle-status', [AdminController::class, 'toggleStatus'])
         ->name('accounts.toggle-status');
    
    // Admin Logs
    Route::get('logs', [AdminLogController::class, 'index'])->name('logs.index');
});

Route::prefix('keranjang')->group(function () {
    Route::get('/{id_pengguna}', [CartController::class, 'show']); // Menampilkan isi keranjang
    Route::post('/tambah', [CartController::class, 'addToCart']); // Menambahkan produk ke keranjang
    Route::delete('/hapus', [CartController::class, 'removeFromCart']); // Menghapus produk dari keranjang
    Route::delete('/kosongkan/{id_pengguna}', [CartController::class, 'clearCart']); // Mengosongkan keranjang
    Route::get('/total/{id_pengguna}', [CartController::class, 'calculateTotal']); // Menghitung total harga
    Route::put('/keranjang/perbarui', [CartController::class, 'updateQuantity']); // Memperbarui kuantitas produk
});
