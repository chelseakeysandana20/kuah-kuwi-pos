<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - POS Kuah Kuwi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F8F9FA] font-sans h-screen flex flex-col overflow-hidden">
    
    <!-- Top Header Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200 px-6 py-3 flex justify-between items-center z-20 shrink-0">
        <div class="w-64 flex items-center gap-2">
            <h1 class="text-2xl font-extrabold text-[#D21F2B] tracking-tight">kasir.in</h1>
            <span class="text-gray-300 font-light">|</span>
            <span class="text-xs font-bold text-gray-600 bg-gray-100 px-2.5 py-1 rounded-full">Kuah Kuwi</span>
        </div>

        <div class="flex gap-8 items-center justify-center">
            <!-- Menu Beranda -->
            <a href="{{ route('kasir.index') }}" class="flex items-center gap-2 px-3.5 py-1.5 rounded-full text-sm {{ request()->routeIs('kasir.index') ? 'bg-red-50 text-[#D21F2B] font-bold' : 'text-gray-500 font-semibold hover:text-gray-800 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Beranda
            </a>

            <!-- Menu Open Ticket -->
            <a href="{{ route('kasir.openticket') }}" class="flex items-center gap-2 px-3.5 py-1.5 rounded-full text-sm {{ request()->routeIs('kasir.openticket*') ? 'bg-red-50 text-[#D21F2B] font-bold' : 'text-gray-500 font-semibold hover:text-gray-800 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Open Ticket
            </a>

            <!-- Menu Riwayat -->
            <a href="{{ route('kasir.riwayat') }}" class="flex items-center gap-2 px-3.5 py-1.5 rounded-full text-sm {{ request()->routeIs('kasir.riwayat*') ? 'bg-red-50 text-[#D21F2B] font-bold' : 'text-gray-500 font-semibold hover:text-gray-800 hover:bg-gray-50' }} transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Riwayat
            </a>
        </div>

        <div class="flex items-center gap-3 w-64 justify-end">
            <span class="hidden sm:inline-block text-xs font-bold text-gray-500 bg-gray-50 border border-gray-200 px-3 py-1.5 rounded-full">
                Riwayat Transaksi
            </span>
            <div class="w-9 h-9 rounded-full bg-[#D21F2B] text-white font-extrabold text-xs flex items-center justify-center shadow-sm shrink-0">
                KA
            </div>
        </div>
    </nav>

    <!-- Body Wrapper -->
    <div class="flex flex-1 overflow-hidden">
        
        <!-- Area Utama Tabel Riwayat -->
        <main class="flex-1 p-6 overflow-y-auto">
            <div class="flex flex-col items-start gap-3 mb-5">
                <div>
                    <h2 class="text-xl font-extrabold text-gray-900">Daftar Riwayat Pesanan</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Arsip permanen seluruh transaksi penjualan Kuah Kuwi</p>
                </div>

                <!-- Filter Bulan & Pencarian Nota -->
                <form method="GET" action="{{ route('kasir.riwayat') }}" class="w-full bg-white p-3 rounded-2xl border border-gray-200 shadow-sm flex flex-wrap items-center justify-between gap-3">
                    <!-- Input Pencarian dengan Ikon Kaca Pembesar -->
                    <div class="relative flex-1 min-w-[240px]">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103.5 10.5a7.5 7.5 0 0013.15 6.15z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nota, meja, atau nama menu..."
                            class="w-full text-xs border border-gray-200 bg-gray-50 focus:bg-white rounded-xl pl-10 pr-3.5 py-2 text-gray-800 focus:outline-none focus:border-[#D21F2B] transition">
                    </div>

                    <!-- Pemilih Bulan & Tombol Aksi -->
                    <div class="flex items-center gap-2">
                        <input type="month" name="month" value="{{ request('month') }}" title="Pilih Bulan Riwayat"
                            class="text-xs border border-gray-200 bg-gray-50 focus:bg-white rounded-xl px-3 py-2 text-gray-700 focus:outline-none focus:border-[#D21F2B] transition">

                        <button type="submit" class="bg-[#D21F2B] hover:bg-[#b51924] text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-sm">
                            Filter
                        </button>

                        @if(request()->hasAny(['search', 'month']))
                            <a href="{{ route('kasir.riwayat') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-3.5 py-2 rounded-xl border border-gray-200 transition">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#4B090C] text-white text-xs uppercase tracking-wider">
                            <th class="py-3.5 px-6 font-bold">Nota</th>
                            <th class="py-3.5 px-6 font-bold">Meja / Tipe</th>
                            <th class="py-3.5 px-6 font-bold">Date</th>
                            <th class="py-3.5 px-6 font-bold">Total</th>
                            <th class="py-3.5 px-6 font-bold">Pembayaran</th>
                            <th class="py-3.5 px-6 font-bold text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($riwayatTransaksi as $trx)
                        <tr class="hover:bg-red-50/40 transition">
                            <td class="py-4 px-6 font-bold text-gray-900">{{ $trx->receipt_number }}</td>
                            <td class="py-4 px-6 text-gray-600 font-medium">{{ $trx->table_number ?? '-' }}</td>
                            <td class="py-4 px-6 text-gray-500 text-xs">{{ $trx->created_at->format('d-m-Y H:i:s') }}</td>
                            <td class="py-4 px-6 font-bold text-[#D21F2B]">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                            <td class="py-4 px-6">
                                <span class="bg-red-50 text-[#D21F2B] border border-red-100 font-bold px-2.5 py-1 rounded-full text-[11px] uppercase">
                                    {{ $trx->payment_method ?? 'CASH' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button type="button" onclick='showDetail(@json($trx))' class="bg-white border border-gray-200 hover:border-[#D21F2B] hover:text-[#D21F2B] text-gray-700 text-xs font-bold px-3.5 py-1.5 rounded-xl shadow-sm transition">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400 italic text-sm">
                                Belum ada riwayat transaksi yang sesuai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Navigasi Halaman (Pagination untuk ribuan transaksi lintas bulan) -->
            <div class="mt-4">
                {{ $riwayatTransaksi->links() }}
            </div>
        </main>

        <!-- Panel Kanan: Detail Pesanan yang Dipilih -->
        <aside class="w-1/3 bg-white p-6 border-l border-gray-200 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                    <h2 class="text-lg font-extrabold text-[#D21F2B]">Detail pesanan</h2>
                    <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-red-50 text-[#D21F2B]">Kuah Kuwi</span>
                </div>
                
                <div id="detail-items-container" class="space-y-3.5 max-h-[420px] overflow-y-auto pr-2 mb-4">
                    <div class="text-gray-400 text-center py-20 text-sm italic">
                        Pilih "Lihat Detail" pada tabel untuk melihat rincian pesanan
                    </div>
                </div>
            </div>

            <!-- Total Harga & Tombol Cetak Struk -->
            <div id="detail-footer" class="border-t border-dashed border-gray-200 pt-4 hidden">
                <div class="flex justify-between text-xs text-gray-500 mb-2">
                    <span>Sub Total</span>
                    <span id="detail-subtotal" class="font-bold text-gray-800">Rp 0</span>
                </div>
                <div class="flex justify-between font-extrabold text-lg text-gray-900 mb-4">
                    <span>Total</span>
                    <span id="detail-total" class="text-[#D21F2B]">Rp 0</span>
                </div>
                
                <a id="btn-print-struk" href="#" target="_blank" class="block text-center bg-[#D21F2B] hover:bg-[#b51924] text-white font-bold py-3 rounded-xl transition shadow-md text-sm">
                    Cetak Struk Ulang
                </a>
            </div>
        </aside>

    </div>

    <script>
        function showDetail(trx) {
            let container = document.getElementById('detail-items-container');
            container.innerHTML = '';

            if (!trx.details || trx.details.length === 0) {
                container.innerHTML = `<div class="text-gray-400 text-center py-10 text-sm italic">Tidak ada item pada transaksi ini.</div>`;
            } else {
                trx.details.forEach(detail => {
                    const productName = detail.product ? detail.product.name : (detail.product_name || 'Menu Terhapus');
                    const qty = detail.quantity ?? 1;
                    const price = Number(detail.price ?? 0);
                    const subtotal = Number(detail.subtotal ?? (price * qty));

                    container.innerHTML += `
                        <div class="flex justify-between items-start bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <div>
                                <h4 class="font-bold text-sm text-gray-800">${productName} <span class="text-[#D21F2B] ml-1">${qty}x</span></h4>
                                <p class="text-xs text-gray-400 mt-0.5">Harga: Rp ${price.toLocaleString('id-ID')}</p>
                            </div>
                            <span class="font-bold text-sm text-gray-800">Rp ${subtotal.toLocaleString('id-ID')}</span>
                        </div>
                    `;
                });
            }

            // Tampilkan subtotal dan total
            document.getElementById('detail-subtotal').innerText = `Rp ${Number(trx.total_amount).toLocaleString('id-ID')}`;
            document.getElementById('detail-total').innerText = `Rp ${Number(trx.total_amount).toLocaleString('id-ID')}`;
            
            // Atur link tombol cetak struk
            let printBtn = document.getElementById('btn-print-struk');
            printBtn.href = `/kasir/struk/${trx.id}`;

            // Tampilkan footer panel kanan
            document.getElementById('detail-footer').classList.remove('hidden');
        }
    </script>
</body>
</html>