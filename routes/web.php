<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\UserCartManagement\CartController;
use App\Http\Controllers\adminControllers\AdminController;
use App\Http\Controllers\adminControllers\AdminLogController;

Route::prefix('keranjang')->group(function () {
    Route::get('/{id_pengguna}', [CartController::class, 'show']); // Menampilkan isi keranjang
    Route::post('/tambah', [CartController::class, 'addToCart']); // Menambahkan produk ke keranjang
    Route::delete('/hapus', [CartController::class, 'removeFromCart']); // Menghapus produk dari keranjang
    Route::delete('/kosongkan/{id_pengguna}', [CartController::class, 'clearCart']); // Mengosongkan keranjang
    Route::get('/total/{id_pengguna}', [CartController::class, 'calculateTotal']); // Menghitung total harga
    Route::put('/keranjang/perbarui', [CartController::class, 'updateQuantity']); // Memperbarui kuantitas produk
});

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    // Admin Account Management
    Route::resource('accounts', AdminController::class);
    Route::patch('accounts/{admin}/toggle-status', [AdminController::class, 'toggleStatus'])
         ->name('accounts.toggle-status');
    
    // Admin Logs
    Route::get('logs', [AdminLogController::class, 'index'])->name('logs.index');
});
