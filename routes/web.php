<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserCartManagement\CartController;
use App\Http\Controllers\adminControllers\AdminController;
use App\Http\Controllers\adminControllers\AdminLogController;

//Admin (Rayhan)
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::post('/admin', [\App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
Route::put('/admin/{admin}', [\App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/{admin}', [\App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.destroy');
Route::patch('/admin/{admin}/toggle-status', [\App\Http\Controllers\AdminController::class, 'toggleStatus'])->name('admin.toggle-status');

// Admin Log routes
Route::get('/admin-logs', [\App\Http\Controllers\AdminLogController::class, 'index'])->name('admin-logs.index');
Route::get('/admin-logs/{log}', [\App\Http\Controllers\AdminLogController::class, 'show'])->name('admin-logs.show');

// Optional: Export logs
Route::get('/admin-logs/export', [\App\Http\Controllers\AdminLogController::class, 'export'])->name('admin-logs.export');

// Optional: Filter logs
Route::get('/admin-logs/filter', [\App\Http\Controllers\AdminLogController::class, 'filter'])->name('admin-logs.filter');

Route::prefix('keranjang')->group(function () {
    Route::get('/{id_pengguna}', [CartController::class, 'show']); // Menampilkan isi keranjang
    Route::post('/tambah', [CartController::class, 'addToCart']); // Menambahkan produk ke keranjang
    Route::delete('/hapus', [CartController::class, 'removeFromCart']); // Menghapus produk dari keranjang
    Route::delete('/kosongkan/{id_pengguna}', [CartController::class, 'clearCart']); // Mengosongkan keranjang
    Route::get('/total/{id_pengguna}', [CartController::class, 'calculateTotal']); // Menghitung total harga
    Route::put('/keranjang/perbarui', [CartController::class, 'updateQuantity']); // Memperbarui kuantitas produk
});
