<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class OwnerController extends Controller
{
    public function dashboard(Request $request)
    {
        $period = $request->get('period', 'hari_ini');
        $now = Carbon::now();

        if ($period === 'minggu_ini') {
            $startDate = $now->copy()->startOfWeek();
            $endDate   = $now->copy()->endOfWeek();
            $prevStart = $now->copy()->subWeek()->startOfWeek();
            $prevEnd   = $now->copy()->subWeek()->endOfWeek();
        } elseif ($period === 'bulan_ini') {
            $startDate = $now->copy()->startOfMonth();
            $endDate   = $now->copy()->endOfMonth();
            $prevStart = $now->copy()->subMonth()->startOfMonth();
            $prevEnd   = $now->copy()->subMonth()->endOfMonth();
        } else {
            $startDate = $now->copy()->startOfDay();
            $endDate   = $now->copy()->endOfDay();
            $prevStart = $now->copy()->subDay()->startOfDay();
            $prevEnd   = $now->copy()->subDay()->endOfDay();
        }

        // Deteksi otomatis nama kolom nominal di tabel transactions
        $amountCol = Schema::hasColumn('transactions', 'total_amount') ? 'total_amount'
                   : (Schema::hasColumn('transactions', 'total_price') ? 'total_price' : 'total');

        // Deteksi otomatis nama kolom jumlah di tabel transaction_details
        $qtyCol = Schema::hasColumn('transaction_details', 'quantity') ? 'quantity' : 'qty';

        // Query transaksi lunas (abaikan yang berstatus 'open' / belum bayar)
        $ordersQuery = DB::table('transactions')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'open');

        $prevOrdersQuery = DB::table('transactions')
            ->whereBetween('created_at', [$prevStart, $prevEnd])
            ->where('status', '!=', 'open');

        // 1. Total Nota
        $totalNota     = (clone $ordersQuery)->count();
        $prevTotalNota = (clone $prevOrdersQuery)->count();
        $notaGrowth    = $this->calculateGrowth($totalNota, $prevTotalNota);

        // 2. Pendapatan Kotor
        $pendapatanKotor     = (clone $ordersQuery)->sum($amountCol);
        $prevPendapatanKotor = (clone $prevOrdersQuery)->sum($amountCol);
        $pendapatanGrowth    = $this->calculateGrowth($pendapatanKotor, $prevPendapatanKotor);

        // 3. Total Pesanan (Item Terjual)
        $transactionIds     = (clone $ordersQuery)->pluck('id');
        $prevTransactionIds = (clone $prevOrdersQuery)->pluck('id');

        $totalPesanan     = DB::table('transaction_details')->whereIn('transaction_id', $transactionIds)->sum($qtyCol);
        $prevTotalPesanan = DB::table('transaction_details')->whereIn('transaction_id', $prevTransactionIds)->sum($qtyCol);
        $pesananGrowth    = $this->calculateGrowth($totalPesanan, $prevTotalPesanan);

        // 4. Top Selling Items & Best Seller
        $topItems = DB::table('transaction_details')
            ->join('products', 'transaction_details.product_id', '=', 'products.id')
            ->whereIn('transaction_details.transaction_id', $transactionIds)
            ->select('products.name', DB::raw("SUM(transaction_details.{$qtyCol}) as total_qty"))
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        $bestSeller = $topItems->first();

        // 5. Grafik Arus Penjualan & Pendapatan Per Jam (11.00 - 23.00)
        $hours = range(11, 23);
        $hourLabels = [];
        $dineInData = [];
        $takeAwayData = [];

        $ordersForChart = (clone $ordersQuery)->get();

        foreach ($hours as $h) {
            $hourLabels[] = $h === 12 ? '12.00 (Makan Siang)' : sprintf('%02d.00', $h);

            $hourlyOrders = $ordersForChart->filter(function ($order) use ($h) {
                return Carbon::parse($order->created_at)->hour === $h;
            });

            $dineInSum   = $hourlyOrders->filter(fn($o) => !empty($o->table_number))->sum($amountCol);
            $takeAwaySum = $hourlyOrders->filter(fn($o) => empty($o->table_number))->sum($amountCol);

            $dineInData[]   = (int) $dineInSum;
            $takeAwayData[] = (int) $takeAwaySum;
        }

        $totalDineIn   = array_sum($dineInData);
        $totalTakeAway = array_sum($takeAwayData);

        return view('owner.dashboard', compact(
            'period',
            'totalPesanan',
            'pesananGrowth',
            'totalNota',
            'notaGrowth',
            'pendapatanKotor',
            'pendapatanGrowth',
            'bestSeller',
            'topItems',
            'hourLabels',
            'dineInData',
            'takeAwayData',
            'totalDineIn',
            'totalTakeAway'
        ));
    }

    public function exportLaporan(Request $request)
    {
        $period = $request->get('period', 'hari_ini');
        $now = Carbon::now();

        if ($period === 'minggu_ini') {
            $startDate = $now->copy()->startOfWeek();
            $endDate   = $now->copy()->endOfWeek();
        } elseif ($period === 'bulan_ini') {
            $startDate = $now->copy()->startOfMonth();
            $endDate   = $now->copy()->endOfMonth();
        } else {
            $startDate = $now->copy()->startOfDay();
            $endDate   = $now->copy()->endOfDay();
        }

        $amountCol = Schema::hasColumn('transactions', 'total_amount') ? 'total_amount'
                   : (Schema::hasColumn('transactions', 'total_price') ? 'total_price' : 'total');

        $orders = DB::table('transactions')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'open')
            ->orderByDesc('created_at')
            ->get();

        $filename = "laporan-kuahkuwi-{$period}-" . date('Ymd_His') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($orders, $amountCol) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID Nota', 'Waktu Transaksi', 'Meja / Tipe', 'Metode Pembayaran', 'Total (Rp)']);

            foreach ($orders as $order) {
                fputcsv($file, [
                    '#' . $order->id,
                    $order->created_at,
                    !empty($order->table_number) ? 'Meja ' . $order->table_number : 'Bawa Pulang',
                    strtoupper($order->payment_method ?? '-'),
                    $order->{$amountCol} ?? 0,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100.0 : 0.0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }
}