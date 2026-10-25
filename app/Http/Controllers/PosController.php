<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
// Tambahan baru untuk fitur checkout:
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PosController extends Controller
{
    public function index()
    {
        // Mengambil semua kategori beserta produknya
        $categories = Category::all();
        
        // Mengambil semua produk yang statusnya tersedia (is_available = true)
        $products = Product::with('category')->where('is_available', true)->get();

        // Mengirim data ke halaman view kasir/pos.blade.php
        return view('kasir.pos', compact('categories', 'products'));
    }

    // Fungsi baru untuk memproses pembayaran dan menyimpan ke database
    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            foreach ($request->items as $item) {
                $product = Product::find($item['id']);
                $totalAmount += $product->price * $item['quantity'];
            }

            // 1. Simpan ke tabel transactions
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'receipt_number' => 'KK-' . strtoupper(Str::random(6)), // Contoh: KK-A1B2C3
                'total_amount' => $totalAmount,
            ]);

            // 2. Simpan ke tabel transaction_details
            foreach ($request->items as $item) {
                $product = Product::find($item['id']);
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['quantity'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil! No Nota: ' . $transaction->receipt_number
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}