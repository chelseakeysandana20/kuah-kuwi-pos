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
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PosController extends Controller
{
    public function index(Request $request)
    {
    // Mengambil semua kategori untuk ditampilkan di sidebar
    $categories = Category::all();

    // Cek apakah ada filter kategori yang diklik (mengambil ID kategori dari URL)
    $categoryId = $request->get('category_id');

    // Jika kategori dipilih, filter produk berdasarkan category_id tersebut
    if ($categoryId) {
        $products = Product::with('category')
            ->where('is_available', 1)
            ->where('category_id', $categoryId)
            ->get();
    } else {
        // Default: Jika belum ada yang diklik, ambil kategori pertama (misal: Noodle)
        $defaultCategory = $categories->first();
        $categoryId = $defaultCategory ? $defaultCategory->id : null;

        $products = Product::with('category')
            ->where('is_available', 1)
            ->when($categoryId, function($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->get();
    }

    // Hitung Rekap Penjualan Hari Ini untuk Modal Tutup Kasir
        $today = Carbon::today();
        $amountCol = Schema::hasColumn('transactions', 'total_amount') ? 'total_amount'
                   : (Schema::hasColumn('transactions', 'total_price') ? 'total_price' : 'total');

        $todayTransactions = DB::table('transactions')
            ->whereDate('created_at', $today)
            ->where('status', '!=', 'open')
            ->get();

        $rekapHariIni = [
            'report_id'       => 'RPT' . $today->format('dmY'),
            'tanggal'         => $today->translatedFormat('d F Y'),
            'total_transaksi' => $todayTransactions->count(),
            'total_income'    => $todayTransactions->sum($amountCol),
            'total_cash'      => $todayTransactions->filter(fn($t) => strtolower($t->payment_method ?? '') === 'cash')->sum($amountCol),
            'total_qris'      => $todayTransactions->filter(fn($t) => strtolower($t->payment_method ?? '') === 'qris')->sum($amountCol),
        ];

    // Mengirim data ke view kasir/pos.blade.php
    return view('kasir.pos', compact('categories', 'products', 'categoryId'));
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

    public function riwayat(Request $request)
    {
        $query = \App\Models\Transaction::with('details.product')
            ->where('status', 'paid')
            ->orderBy('created_at', 'desc');

        // Filter rentang tanggal bebas (lintas bulan / tahun)
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Pencarian kode nota atau nomor meja
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('receipt_number', 'like', "%{$search}%")
                  ->orWhere('table_number', 'like', "%{$search}%");
            });
        }

        $riwayatTransaksi = $query->paginate(20)->withQueryString();

        return view('kasir.riwayat', compact('riwayatTransaksi'));
    }

    public function downloadLaporanTutupKasir()
    {
        $today = Carbon::today();
        $amountCol = Schema::hasColumn('transactions', 'total_amount') ? 'total_amount'
                   : (Schema::hasColumn('transactions', 'total_price') ? 'total_price' : 'total');

        $transactions = DB::table('transactions')
            ->whereDate('created_at', $today)
            ->where('status', '!=', 'open')
            ->orderBy('created_at', 'asc')
            ->get();

        $reportId = 'RPT' . $today->format('dmY');
        $filename = "Laporan-Tutup-Kasir-{$reportId}.csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($transactions, $amountCol, $reportId, $today) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID Report', $reportId]);
            fputcsv($file, ['Tanggal', $today->format('d-m-Y')]);
            fputcsv($file, ['Total Transaksi', $transactions->count()]);
            fputcsv($file, ['Total Cash (Rp)', $transactions->filter(fn($t) => strtolower($t->payment_method ?? '') === 'cash')->sum($amountCol)]);
            fputcsv($file, ['Total QRIS (Rp)', $transactions->filter(fn($t) => strtolower($t->payment_method ?? '') === 'qris')->sum($amountCol)]);
            fputcsv($file, ['Total Income (Rp)', $transactions->sum($amountCol)]);
            fputcsv($file, []);
            fputcsv($file, ['No Nota', 'Jam', 'Meja / Tipe', 'Metode Pembayaran', 'Nominal (Rp)']);

            foreach ($transactions as $trx) {
                fputcsv($file, [
                    '#' . $trx->id,
                    Carbon::parse($trx->created_at)->format('H:i'),
                    !empty($trx->table_number) ? 'Meja ' . $trx->table_number : 'Bawa Pulang',
                    strtoupper($trx->payment_method ?? '-'),
                    $trx->{$amountCol} ?? 0,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function konfirmasiTutupKasir(Request $request)
    {
        if ($request->filled('catatan_hari_ini')) {
            \Log::info('Catatan Tutup Kasir (' . now()->format('Y-m-d') . '): ' . $request->catatan_hari_ini);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Kasir telah ditutup. Terima kasih atas kerja keras hari ini!');
    }

    public function getRekapHariIni()
    {
        $nowJakarta = \Carbon\Carbon::now('Asia/Jakarta');

        // Ambil semua transaksi lunas ('paid') persis seperti method riwayat()
        $paidTransactions = \App\Models\Transaction::with('details')
            ->where('status', 'paid')
            ->get();

        // Filter transaksi hari ini (WIB), jika 0 gunakan seluruh transaksi 'paid' yang tampil di Riwayat
        $todayJakarta = $nowJakarta->toDateString();
        $todayOnly = $paidTransactions->filter(function ($trx) use ($todayJakarta) {
            $c = $trx->created_at ? \Carbon\Carbon::parse($trx->created_at)->timezone('Asia/Jakarta')->toDateString() : '';
            $u = $trx->updated_at ? \Carbon\Carbon::parse($trx->updated_at)->timezone('Asia/Jakarta')->toDateString() : '';
            return $c === $todayJakarta || $u === $todayJakarta;
        });

        $transactions = $todayOnly->isNotEmpty() ? $todayOnly : $paidTransactions;

        // Ambil nominal dari kolom yang tersedia di tabel transactions atau hitung dari details
        $getAmount = function ($trx) {
            $raw = $trx->total_price ?? $trx->total_amount ?? $trx->grand_total ?? $trx->total ?? $trx->subtotal ?? 0;
            if ((float) $raw > 0) {
                return (float) $raw;
            }
            return (float) $trx->details->sum(fn($d) => ($d->subtotal ?? ($d->price * $d->quantity)));
        };

        $totalIncome = $transactions->sum($getAmount);

        // --- BAGIAN YANG DIGANTI MULAI SINI ---
        $getMethodString = function ($trx) {
            $direct = $trx->payment_method
                ?? $trx->metode_pembayaran
                ?? $trx->payment
                ?? $trx->method
                ?? $trx->payment_type
                ?? $trx->metode
                ?? $trx->metode_bayar
                ?? $trx->jenis_pembayaran
                ?? null;

            if (!empty($direct)) {
                return strtolower((string) $direct);
            }

            return strtolower(implode(' ', array_map('strval', array_values($trx->getAttributes()))));
        };

        $totalCash = $transactions->filter(function ($trx) use ($getMethodString) {
            $m = $getMethodString($trx);
            return str_contains($m, 'cash') || str_contains($m, 'tunai');
        })->sum($getAmount);

        $totalQris = $transactions->filter(function ($trx) use ($getMethodString) {
            $m = $getMethodString($trx);
            return str_contains($m, 'qris');
        })->sum($getAmount);

        $unclassified = $totalIncome - ($totalCash + $totalQris);
        if ($unclassified > 0) {
            $totalCash += $unclassified;
        }
        // --- BAGIAN YANG DIGANTI SAMPAI SINI ---

        return response()->json([
            'report_id'       => 'RPT' . $nowJakarta->format('dmY'),
            'tanggal'         => $nowJakarta->translatedFormat('d F Y'),
            'total_transaksi' => $transactions->count(),
            'total_income'    => $totalIncome,
            'total_cash'      => $totalCash,
            'total_qris'      => $totalQris,
        ]);
    }
}