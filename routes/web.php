<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\StokController;

// Route Publik (Bisa diakses tanpa login)
Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;
        if ($role === 'owner') {
            return redirect()->route('owner.dashboard');
        }
        if ($role === 'staff_dapur') {
            return redirect()->route('dapur.stok');
        }
        return redirect()->route('kasir.index');
    }

    return view('landing');
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
        Route::get('/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
        Route::get('/dashboard/export', [OwnerController::class, 'exportLaporan'])->name('owner.export');
    });

    // Grup Khusus Kasir
    Route::middleware('role:kasir')->prefix('kasir')->group(function () {
        Route::get('/pos', [PosController::class, 'index'])->name('kasir.index');
        Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('kasir.checkout');
        Route::get('/struk/{id}', [PosController::class, 'cetakStruk'])->name('kasir.struk');
        Route::get('/openticket', [PosController::class, 'openTicket'])->name('kasir.openticket');
        Route::post('/openticket/complete/{id}', [PosController::class, 'completeTicket'])->name('kasir.openticket.complete');
        Route::get('/riwayat', [PosController::class, 'riwayat'])->name('kasir.riwayat');
        Route::get('/tutup-kasir/download', [PosController::class, 'downloadLaporanTutupKasir'])->name('kasir.tutup.download');
        Route::post('/tutup-kasir/konfirmasi', [PosController::class, 'konfirmasiTutupKasir'])->name('kasir.tutup.konfirmasi');
        Route::get('/kasir/rekap-hari-ini', [PosController::class, 'getRekapHariIni'])->name('kasir.rekap');
    });

    // Grup Khusus Staff Dapur
    Route::middleware('role:staff_dapur')->prefix('dapur')->group(function () {
        Route::get('/stok', [StokController::class, 'index'])->name('dapur.stok');
        Route::post('/stok', [StokController::class, 'store'])->name('dapur.stok.store');
        Route::patch('/stok/{id}', [StokController::class, 'updateStock'])->name('dapur.stok.update');
        Route::get('/stok/export', [StokController::class, 'export'])->name('dapur.stok.export');
        Route::get('/tutup-kasir/download', [PosController::class, 'downloadLaporanTutupKasir'])->name('kasir.tutup.download');
        Route::post('/tutup-kasir/konfirmasi', [PosController::class, 'konfirmasiTutupKasir'])->name('kasir.tutup.konfirmasi');
    });
});