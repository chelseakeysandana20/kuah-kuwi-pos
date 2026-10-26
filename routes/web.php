<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PosController;
use Illuminate\Support\Facades\Auth;

// Route Publik (Bisa diakses tanpa login)
Route::get('/', function () {
    // Jika kasir sudah login, langsung lempar ke halaman POS
    if (Auth::check()) {
        return redirect()->route('kasir.pos'); // Sesuaikan dengan nama rute pos milikmu
    }
    // Jika belum login, barulah tampilkan splash screen
    return view('kasir.landing');
});

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
        Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('kasir.checkout');
    });

    // Grup Khusus Staff Dapur
    Route::middleware('role:staff_dapur')->prefix('dapur')->group(function () {
        Route::get('/stok', function () {
            return 'Halaman Manajemen Stok Bahan Baku';
        })->name('dapur.stok');
    });
});