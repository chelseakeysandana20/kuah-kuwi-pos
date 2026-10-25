<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek apakah role user sesuai dengan yang diizinkan di route
        if (Auth::user()->role !== $role) {
            // Jika kasir mencoba buka halaman owner, tolak akses (403 Forbidden)
            abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk membuka halaman ini.');
        }

        return $next($request);
    }
}