<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Selesai - {{ $transaction->receipt_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS Khusus untuk Printer Thermal */
        @media print {
            body { background-color: white; margin: 0; display: block; }
            /* Sembunyikan bayangan, tombol, dan warna background saat dicetak */
            .no-print { display: none !important; }
            .receipt-card { box-shadow: none !important; margin: 0 !important; width: 80mm !important; max-width: 80mm !important; padding: 0 !important; }
            .green-banner { background-color: transparent !important; color: black !important; border-bottom: 1px dashed black; }
            @page { margin: 0; }
        }
    </style>
</head>
<body class="bg-gray-200 flex justify-center items-center min-h-screen font-sans">

    <!-- Card Pembayaran Selesai -->
    <div class="receipt-card bg-white shadow-2xl rounded-3xl w-full max-w-sm overflow-hidden my-8">
        
        <!-- Header: Total -->
        <div class="text-center pt-8 pb-4">
            <h1 class="text-3xl font-bold text-gray-900">Rp.{{ number_format($transaction->total_amount, 0, '.', '.') }}</h1>
            <p class="text-gray-500 text-sm font-medium mt-1">Total</p>
        </div>

        <!-- Banner Hijau -->
        <div class="green-banner bg-green-700 text-white text-center py-3">
            <h2 class="text-lg font-semibold">Pembayaran selesai</h2>
        </div>

        <!-- Detail Transaksi -->
        <div class="p-6">
            
            <!-- Info Waktu & Nomor Nota -->
            <div class="space-y-1 text-xs text-gray-500 mb-6">
                <div class="flex justify-between">
                    <span>Date/Time</span>
                    <span class="text-gray-800 text-right">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Invoice</span>
                    <span class="text-gray-800 text-right">{{ $transaction->receipt_number }}</span>
                </div>
            </div>

            <!-- Daftar Pesanan -->
            <div class="space-y-1 text-xs text-gray-500 mb-6">
                @foreach($transaction->details as $item)
                <div class="flex justify-between">
                    <span class="text-gray-800">{{ $item->product->name }} <span class="ml-1 text-gray-400">{{ $item->quantity }}x</span></span>
                    <span class="text-gray-800">{{ number_format($item->product->price * $item->quantity, 0, '.', '.') }}</span>
                </div>
                @endforeach
                
                <!-- Spacer -->
                <div class="h-2"></div>
                
                <div class="flex justify-between font-bold text-sm text-gray-900 pt-2 border-t border-gray-100">
                    <span>Amount</span>
                    <span>{{ number_format($transaction->total_amount, 0, '.', '.') }}</span>
                </div>
                
                @if($transaction->note)
                <div class="pt-2 text-gray-400 italic">
                    Catatan: {{ $transaction->note }}
                </div>
                @endif
            </div>

            <!-- Area Bawah & Tombol Cetak (Sembunyi saat diprint) -->
            <div class="no-print border-t border-gray-200 pt-6 flex justify-between items-end">
                <div>
                    <p class="text-xs text-gray-400 mb-1">Payment method</p>
                    <p class="font-medium text-gray-900">Cash</p>
                </div>
                <button onclick="window.print()" class="bg-[#DE3B4C] hover:bg-red-700 text-white font-bold py-2 px-5 rounded-2xl transition shadow-md">
                    Cetak struk
                </button>
            </div>

        </div>
    </div>

</body>
</html>