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
            body { background-color: white !important; margin: 0 !important; padding: 0 !important; display: block !important; }
            /* Sembunyikan bayangan, tombol, dan warna background saat dicetak */
            .no-print { display: none !important; }
            .receipt-wrapper { display: block !important; width: 80mm !important; max-width: 80mm !important; margin: 0 !important; padding: 0 !important; }
            .receipt-card { box-shadow: none !important; border-radius: 0 !important; margin: 0 !important; width: 80mm !important; max-width: 80mm !important; padding: 0 !important; border: none !important; }
            .green-banner { background-color: transparent !important; color: black !important; border-bottom: 1px dashed black; }
            .kitchen-banner { background-color: transparent !important; color: black !important; border-top: 2px solid black; border-bottom: 2px solid black; }
            /* Pemotong kertas otomatis antara Struk Pelanggan dan Struk Dapur */
            .page-break { page-break-after: always; break-after: page; }
            @page { margin: 0; }
        }
    </style>
</head>
<body class="bg-gray-200 flex justify-center items-start min-h-screen font-sans py-8 px-4">

    <div class="receipt-wrapper flex flex-col md:flex-row items-start justify-center gap-6 w-full max-w-3xl">

        <!-- ========================================== -->
        <!-- STRUK 1: STRUK PEMBAYARAN PELANGGAN        -->
        <!-- ========================================== -->
        <div class="receipt-card page-break bg-white shadow-2xl rounded-3xl w-full max-w-sm overflow-hidden mx-auto">
            
            <!-- Header: Total -->
            <div class="text-center pt-8 pb-4">
                <p class="text-[11px] font-bold uppercase tracking-widest text-gray-400 mb-1">Kuah Kuwi • Struk Pelanggan</p>
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
                        <span class="text-gray-800 text-right font-semibold">{{ $transaction->receipt_number }}</span>
                    </div>
                    @if(!empty($transaction->order_type))
                    <div class="flex justify-between">
                        <span>Tipe Pesanan</span>
                        <span class="text-gray-800 text-right font-semibold">{{ $transaction->order_type }}</span>
                    </div>
                    @endif
                </div>

                <!-- Daftar Pesanan -->
                <div class="space-y-1.5 text-xs text-gray-500 mb-6">
                    @foreach($transaction->details as $item)
                    <div class="flex justify-between">
                        <span class="text-gray-800">{{ $item->product->name }} <span class="ml-1 text-gray-400 font-semibold">{{ $item->quantity }}x</span></span>
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
                    <div class="pt-2 text-gray-500 italic">
                        Catatan: {{ $transaction->note }}
                    </div>
                    @endif
                </div>

                <!-- Area Bawah & Tombol Cetak (Sembunyi saat diprint) -->
                <div class="no-print border-t border-gray-200 pt-5 space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-400 mb-0.5">Payment method</p>
                            <p class="font-semibold text-gray-900 text-sm">{{ $transaction->payment_method ?? 'Cash' }}</p>
                        </div>
                        <button onclick="window.print()" class="bg-[#DE3B4C] hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-2xl transition shadow-md text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Cetak Struk
                        </button>
                    </div>
                    <a href="{{ url('/kasir/pos') }}" class="block w-full text-center py-2 rounded-xl border border-gray-200 text-xs font-bold text-gray-600 hover:bg-gray-50 transition">
                        &larr; Kembali ke Kasir
                    </a>
                </div>

            </div>
        </div>

        <!-- ========================================== -->
        <!-- STRUK 2: STRUK KHUSUS DAPUR (OTOMATIS)     -->
        <!-- ========================================== -->
        <div class="receipt-card bg-white shadow-2xl rounded-3xl w-full max-w-sm overflow-hidden mx-auto border-2 border-dashed border-gray-300">
            
            <!-- Header Dapur -->
            <div class="text-center pt-6 pb-3 px-4">
                <span class="no-print inline-block px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 text-[10px] font-extrabold uppercase tracking-wider mb-2">
                    Otomatis Terkirim ke Dapur
                </span>
                <h2 class="text-2xl font-black tracking-wider text-gray-900 uppercase">STRUK DAPUR</h2>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Kitchen Order Ticket • Kuah Kuwi</p>
            </div>

            <!-- Banner Info Pesanan -->
            <div class="kitchen-banner bg-[#D21F2B] text-white text-center py-2.5 px-4">
                <p class="text-sm font-extrabold tracking-wide uppercase">
                    {{ $transaction->order_type ?? 'Pesanan Baru' }} • {{ $transaction->receipt_number }}
                </p>
            </div>

            <!-- Detail Item Dapur (Hanya Menu, Jumlah & Catatan - Tanpa Harga) -->
            <div class="p-6">
                
                <div class="flex justify-between text-xs text-gray-500 pb-3 mb-4 border-b border-dashed border-gray-300">
                    <span>Waktu Masuk:</span>
                    <span class="font-bold text-gray-900">{{ $transaction->created_at->format('d/m/Y H:i') }} WIB</span>
                </div>

                <!-- Header Kolom -->
                <div class="flex justify-between text-[11px] font-extrabold uppercase tracking-wider text-gray-400 pb-2 border-b border-gray-200">
                    <span>Menu Pesanan</span>
                    <span>Jml</span>
                </div>

                <!-- Daftar Menu & Jumlah -->
                <div class="divide-y divide-dashed divide-gray-200 my-2">
                    @foreach($transaction->details as $item)
                    <div class="py-3 flex items-center justify-between gap-3">
                        <span class="text-sm font-bold text-gray-900 leading-snug">{{ $item->product->name }}</span>
                        <span class="text-base font-black text-gray-900 bg-gray-100 px-2.5 py-0.5 rounded-lg shrink-0">
                            {{ $item->quantity }}x
                        </span>
                    </div>
                    @endforeach
                </div>

                <!-- Catatan Khusus untuk Koki/Staf Dapur -->
                <div class="mt-4 pt-3 border-t-2 border-dashed border-gray-300">
                    <p class="text-[11px] font-extrabold uppercase tracking-wider text-gray-500 mb-1">Catatan Dapur:</p>
                    @if($transaction->note)
                        <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs font-bold text-gray-900">
                            "{{ $transaction->note }}"
                        </div>
                    @else
                        <p class="text-xs text-gray-400 italic">- Tidak ada catatan khusus -</p>
                    @endif
                </div>

                <!-- Footer Struk Dapur -->
                <div class="mt-6 pt-3 border-t border-gray-200 text-center text-[11px] text-gray-400">
                    Harap periksa kelengkapan porsi sebelum disajikan
                </div>
            </div>
        </div>

    </div>

</body>
</html>