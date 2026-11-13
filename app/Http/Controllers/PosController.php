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
            // Tambahkan validasi untuk nomor meja
            'table_number' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $totalAmount = 0;
            foreach ($request->items as $item) {
                $product = Product::find($item['id']);
                $totalAmount += $product->price * $item['quantity'];
            }

            // Tentukan status transaksi (Apakah dari tombol "Simpan" atau "Bayar")
            $statusTransaksi = $request->status == 'saved' ? 'saved' : 'paid';

            // 1. Simpan ke tabel transactions
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'receipt_number' => 'KK-' . strtoupper(Str::random(6)), 
                'total_amount' => $totalAmount,
                'note' => $request->note,
                'table_number' => $request->table_number, // Simpan nomor meja
                'status' => $statusTransaksi, // Simpan status transaksi
                // 'payment_method' => $request->payment_method, // Uncomment jika kolom ini sudah ada di database
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
                'message' => 'Transaksi berhasil diproses! No Nota: ' . $transaction->receipt_number,
                'transaction_id' => $transaction->id 
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cetakStruk($id)
    {
        // Mengambil data transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);
        
        // Melempar data tersebut ke file tampilan struk
        return view('kasir.struk', compact('transaction'));
    }

    public function openTicket()
    {
        // Ambil transaksi yang statusnya 'saved' beserta detail produknya
        $openTickets = Transaction::with('details.product')
                        ->where('status', 'saved')
                        ->latest()
                        ->get();

        return view('kasir.openticket', compact('openTickets'));
    }

    public function completeTicket($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);
            // Ubah status menjadi 'paid' atau 'completed' agar hilang dari open ticket tapi tetap masuk riwayat
            $transaction->update(['status' => 'paid']);

            return response()->json([
                'success' => true,
                'message' => 'Tiket berhasil diselesaikan!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function riwayat()
    {
        // Ambil semua transaksi yang sudah lunas (paid) beserta detail produknya
        $riwayatTransaksi = Transaction::with('details.product')
                            ->where('status', 'paid')
                            ->latest()
                            ->get();

        return view('kasir.riwayat', compact('riwayatTransaksi'));
    }
}