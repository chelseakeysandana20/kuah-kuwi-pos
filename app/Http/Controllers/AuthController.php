<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect paksa berdasarkan role pengguna
            $role = Auth::user()->role;
            if ($role === 'owner') {
                return redirect('/owner/dashboard');
            } elseif ($role === 'kasir') {
                return redirect('/kasir/pos');
            } elseif ($role === 'staff_dapur') {
                return redirect('/dapur/stok');
            }
            
            // Jika role tidak dikenali
            Auth::logout();
            return redirect('/login')->withErrors(['username' => 'Role tidak valid.']);
        }

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }
}