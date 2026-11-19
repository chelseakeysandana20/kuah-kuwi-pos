<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Transaction;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $allIngredients = Ingredient::orderBy('id', 'asc')->get();

        // Hitung 4 Kartu KPI dari seluruh data
        $totalJenis   = $allIngredients->count();
        $stokAman     = $allIngredients->filter(fn($i) => $i->status === 'aman')->count();
        $perluBelanja = $allIngredients->filter(fn($i) => $i->status === 'perlu_belanja')->count();
        $stokHabis    = $allIngredients->filter(fn($i) => $i->status === 'habis')->count();

        // Daftar kategori unik untuk dropdown filter
        $categories = $allIngredients->pluck('category')->unique()->values();

        // Terapkan filter pencarian, kategori, dan status
        $ingredients = $allIngredients;

        if ($request->filled('search')) {
            $keyword = strtolower($request->search);
            $ingredients = $ingredients->filter(function ($item) use ($keyword) {
                return str_contains(strtolower($item->name), $keyword) ||
                       str_contains(strtolower($item->sku ?? ''), $keyword);
            });
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $ingredients = $ingredients->where('category', $request->category);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $ingredients = $ingredients->filter(fn($item) => $item->status === $request->status);
        }

        return view('dapur.stok', compact(
            'ingredients',
            'totalJenis',
            'stokAman',
            'perluBelanja',
            'stokHabis',
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'category'  => 'required|string|max:100',
            'stock'     => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'unit'      => 'required|string|max:50',
        ]);

        $nextId = (Ingredient::max('id') ?? 0) + 1;
        $sku = $request->sku ?: 'BHN-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        Ingredient::create([
            'sku'       => $sku,
            'name'      => $request->name,
            'category'  => $request->category,
            'stock'     => $request->stock,
            'min_stock' => $request->min_stock,
            'unit'      => $request->unit,
        ]);

        return redirect()->route('dapur.stok')->with('success', 'Bahan baku berhasil ditambahkan.');
    }

    public function updateStock(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);

        if ($request->has('action')) {
            if ($request->action === 'increment') {
                $ingredient->increment('stock');
            } elseif ($request->action === 'decrement' && $ingredient->stock > 0) {
                $ingredient->decrement('stock');
            }
        } elseif ($request->filled('stock')) {
            $request->validate(['stock' => 'required|integer|min:0']);
            $ingredient->update(['stock' => $request->stock]);
        }

        return redirect()->route('dapur.stok')->with('success', 'Stok ' . $ingredient->name . ' berhasil diperbarui.');
    }

    public function export()
    {
        $ingredients = Ingredient::orderBy('id', 'asc')->get();
        $filename = 'stok-dapur-kuahkuwi-' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($ingredients) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No', 'SKU', 'Nama Produk / Bahan', 'Keterangan / Kategori', 'Stok Saat Ini', 'Satuan', 'Status']);

            foreach ($ingredients as $index => $item) {
                $statusLabel = match ($item->status) {
                    'habis'         => 'Habis',
                    'perlu_belanja' => 'Perlu Belanja',
                    default         => 'Aman',
                };

                fputcsv($file, [
                    $index + 1,
                    $item->sku ?? '-',
                    $item->name,
                    $item->category,
                    $item->stock,
                    $item->unit,
                    $statusLabel,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function riwayat(Request $request)
    {
        $query = Transaction::with(['details.product'])
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc');

        // Filter pencarian nomor nota, meja/tipe, catatan, atau nama menu
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('receipt_number', 'like', "%{$keyword}%")
                  ->orWhere('table_number', 'like', "%{$keyword}%")
                  ->orWhere('note', 'like', "%{$keyword}%")
                  ->orWhereHas('details.product', function ($pq) use ($keyword) {
                      $pq->where('name', 'like', "%{$keyword}%");
                  });
            });
        }

        // Filter berdasarkan tanggal spesifik
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter berdasarkan bulan (YYYY-MM)
        if ($request->filled('month')) {
            $parts = explode('-', $request->month);
            if (count($parts) === 2) {
                $query->whereYear('created_at', $parts[0])
                      ->whereMonth('created_at', $parts[1]);
            }
        }

        $riwayatDapur = $query->paginate(15)->withQueryString();

        // Ringkasan KPI hari ini untuk staff dapur
        $pesananHariIni = Transaction::where('status', 'completed')
            ->whereDate('created_at', today())
            ->count();

        $totalPorsiHariIni = Transaction::where('status', 'completed')
            ->whereDate('created_at', today())
            ->withSum('details', 'quantity')
            ->get()
            ->sum('details_sum_quantity');

        return view('dapur.riwayat', compact(
            'riwayatDapur',
            'pesananHariIni',
            'totalPorsiHariIni'
        ));
    }
}