<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class PosController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori beserta produknya
        $categories = Category::all();
        
        // Mengambil semua produk yang statusnya tersedia (is_available = true)
        // Kita juga me-load relasi kategorinya agar nama kategori bisa ditampilkan
        $products = Product::with('category')->where('is_available', true)->get();

        // Mengirim data ke halaman view kasir/pos.blade.php
        return view('kasir.pos', compact('categories', 'products'));
    }
}