<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Halaman Landing (Brand)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Halaman Autentikasi (Hanya bisa diakses jika belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Halaman Setelah Login (Dashboard sementara untuk testing)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return 'Login Berhasil! Selamat datang, ' . auth()->user()->name . '. Role Anda: ' . auth()->user()->role;
    })->name('dashboard');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});