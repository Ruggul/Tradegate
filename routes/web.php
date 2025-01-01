<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserCartManagement\CartController;
use App\Http\Controllers\adminControllers\AdminController;
use App\Http\Controllers\adminControllers\AdminAuthController;
use App\Http\Controllers\adminControllers\AdminLogController;

// Admin Auth Routes (Public)
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Admin Protected Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth.admin']], function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Admin Management
    Route::group(['prefix' => 'admins'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admins.index');
        Route::post('/', [AdminController::class, 'store'])->name('admins.store');
        Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
        Route::put('/{admin}', [AdminController::class, 'update'])->name('admins.update');
        Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');
        Route::patch('/{admin}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admins.toggle-status');
    });
    
    // Admin Logs
    Route::group(['prefix' => 'logs', 'as' => 'logs.'], function () {
        Route::get('/', [AdminLogController::class, 'index'])->name('index');
        Route::get('/{log}', [AdminLogController::class, 'show'])->name('show');
        Route::get('/export', [AdminLogController::class, 'export'])->name('export');
        Route::get('/filter', [AdminLogController::class, 'filter'])->name('filter');
        Route::post('/clear', [AdminLogController::class, 'clear'])->name('clear');
    });
});

Route::prefix('keranjang')->group(function () {
    Route::get('/{id_pengguna}', [CartController::class, 'show']); // Menampilkan isi keranjang
    Route::post('/tambah', [CartController::class, 'addToCart']); // Menambahkan produk ke keranjang
    Route::delete('/hapus', [CartController::class, 'removeFromCart']); // Menghapus produk dari keranjang
    Route::delete('/kosongkan/{id_pengguna}', [CartController::class, 'clearCart']); // Mengosongkan keranjang
    Route::get('/total/{id_pengguna}', [CartController::class, 'calculateTotal']); // Menghitung total harga
    Route::put('/keranjang/perbarui', [CartController::class, 'updateQuantity']); // Memperbarui kuantitas produk
});
