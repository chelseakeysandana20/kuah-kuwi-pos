<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PosController;

// Route Publik (Bisa diakses tanpa login)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Route Guest (Hanya bisa diakses jika BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route Auth (Hanya bisa diakses jika SUDAH login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Grup Khusus Owner
    Route::middleware('role:owner')->prefix('owner')->group(function () {
        Route::get('/dashboard', function () {
            return 'Halaman Dashboard Owner (Laporan & Keuangan)';
        })->name('owner.dashboard');
    });

    // Grup Khusus Kasir
    Route::middleware('role:kasir')->prefix('kasir')->group(function () {
        Route::get('/pos', [PosController::class, 'index'])->name('kasir.pos');
    });

    // Grup Khusus Staff Dapur
    Route::middleware('role:staff_dapur')->prefix('dapur')->group(function () {
        Route::get('/stok', function () {
            return 'Halaman Manajemen Stok Bahan Baku';
        })->name('dapur.stok');
    });
});