<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - POS Kuah Kuwi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans h-screen flex flex-col overflow-hidden">
    
    <!-- Top Header Navigation -->
    <nav class="bg-white shadow-sm border-b px-6 py-3 flex justify-between items-center z-10 shrink-0">
        <div class="w-64">
            <h1 class="text-2xl font-bold text-red-600 tracking-tight">kasir.in <span class="text-gray-400 text-sm font-normal">| Kuah Kuwi</span></h1>
        </div>

        <div class="flex gap-10 items-center justify-center">
            <!-- Menu Beranda -->
            <a href="{{ route('kasir.index') }}" class="flex items-center gap-2 {{ request()->routeIs('kasir.index') ? 'text-red-500 font-bold' : 'text-gray-400 font-semibold hover:text-gray-600' }} transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Beranda
            </a>

            <!-- Menu Open Ticket -->
            <a href="{{ route('kasir.openticket') }}" class="flex items-center gap-2 {{ request()->routeIs('kasir.openticket*') ? 'text-red-500 font-bold' : 'text-gray-400 font-semibold hover:text-gray-600' }} transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Open Ticket
            </a>

            <!-- Menu Riwayat -->
            <a href="{{ route('kasir.riwayat') }}" class="flex items-center gap-2 {{ request()->routeIs('kasir.riwayat*') ? 'text-red-500 font-bold' : 'text-gray-400 font-semibold hover:text-gray-600' }} transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Riwayat
            </a>
        </div>

        <div class="flex items-center gap-4 w-64 justify-end">
            <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden border border-gray-200">
                <img src="https://ui-avatars.com/api/?name=Kasir&background=random" alt="Profil Kasir" class="w-full h-full object-cover">
            </div>
        </div>
    </nav>

    <!-- Body Wrapper -->
    <div class="flex flex-1 overflow-hidden">
        
        <!-- Area Utama Tabel Riwayat -->
        <main class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-6">RIWAYAT PESANAN</h2>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-800 text-white text-xs uppercase tracking-wider">
                            <th class="py-3.5 px-6 font-semibold">Nota</th>
                            <th class="py-3.5 px-6 font-semibold">Meja / Tipe</th>
                            <th class="py-3.5 px-6 font-semibold">Date</th>
                            <th class="py-3.5 px-6 font-semibold">Total</th>
                            <th class="py-3.5 px-6 font-semibold">Pembayaran</th>
                            <th class="py-3.5 px-6 font-semibold text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($riwayatTransaksi as $trx)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-medium text-gray-800">{{ $trx->receipt_number }}</td>
                            <td class="py-4 px-6 text-gray-600">{{ $trx->table_number ?? '-' }}</td>
                            <td class="py-4 px-6 text-gray-500 text-xs">{{ $trx->created_at->format('d-m-Y H:i:s') }}</td>
                            <td class="py-4 px-6 font-semibold text-gray-800">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                            <td class="py-4 px-6">
                                <span class="bg-gray-100 text-gray-700 font-semibold px-2.5 py-1 rounded-md text-xs uppercase">
                                    {{ $trx->payment_method ?? 'CASH' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button onclick="showDetail({{ json_encode($trx) }})" class="bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 text-xs font-semibold px-3 py-1.5 rounded-lg shadow-sm transition">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400 italic">
                                Belum ada riwayat transaksi yang selesai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Panel Kanan: Detail Pesanan yang Dipilih -->
        <aside class="w-1/3 bg-white p-6 border-l shadow-sm flex flex-col justify-between">
            <div>
                <h2 class="text-lg font-bold text-slate-800 border-b pb-3 mb-4">Detail pesanan</h2>
                
                <div id="detail-items-container" class="space-y-4 max-h-[420px] overflow-y-auto pr-2 mb-4">
                    <div class="text-gray-400 text-center py-20 text-sm italic">
                        Pilih "Lihat Detail" pada tabel untuk melihat rincian pesanan
                    </div>
                </div>
            </div>

            <!-- Total Harga & Tombol Cetak Struk -->
            <div id="detail-footer" class="border-t border-dashed pt-4 hidden">
                <div class="flex justify-between text-sm text-gray-600 mb-2">
                    <span>Sub Total</span>
                    <span id="detail-subtotal" class="font-medium text-gray-800">Rp 0</span>
                </div>
                <div class="flex justify-between font-bold text-base text-gray-900 mb-4">
                    <span>Total</span>
                    <span id="detail-total">Rp 0</span>
                </div>
                
                <a id="btn-print-struk" href="#" target="_blank" class="block text-center bg-slate-800 hover:bg-slate-900 text-white font-bold py-3 rounded-xl transition shadow-md text-sm">
                    Cetak Struk Ulang
                </a>
            </div>
        </aside>

    </div>

    <script>
        function showDetail(trx) {
            let container = document.getElementById('detail-items-container');
            container.innerHTML = '';

            trx.details.forEach(detail => {
                container.innerHTML += `
                    <div class="flex justify-between items-start border-b border-gray-100 pb-3">
                        <div>
                            <h4 class="font-bold text-sm text-gray-800">${detail.product.name} x${detail.quantity}</h4>
                            <p class="text-xs text-gray-400 mt-0.5">Harga: Rp ${Number(detail.price).toLocaleString('id-ID')}</p>
                        </div>
                        <span class="font-semibold text-sm text-gray-800">Rp ${Number(detail.subtotal).toLocaleString('id-ID')}</span>
                    </div>
                `;
            });

            // Tampilkan subtotal dan total
            document.getElementById('detail-subtotal').innerText = `Rp ${Number(trx.total_amount).toLocaleString('id-ID')}`;
            document.getElementById('detail-total').innerText = `Rp ${Number(trx.total_amount).toLocaleString('id-ID')}`;
            
            // Atur link tombol cetak struk
            let printBtn = document.getElementById('btn-print-struk');
            printBtn.href = `/struk/${trx.id}`;

            // Tampilkan footer panel kanan
            document.getElementById('detail-footer').classList.remove('hidden');
        }
    </script>
</body>
</html>