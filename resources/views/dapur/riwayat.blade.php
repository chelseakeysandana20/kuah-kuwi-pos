<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan Dapur - kasir.in | Kuah Kuwi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FA] h-screen flex flex-col overflow-hidden text-gray-800">

    <!-- Top Navbar -->
    <header class="bg-white border-b border-gray-200 h-16 px-6 flex items-center justify-between shrink-0 z-30">
        <div class="flex items-center gap-10">
            <span class="text-2xl font-extrabold text-[#D21F2B] tracking-tight">kasir.in</span>
            <h1 class="text-base font-bold text-gray-900">Riwayat Pesanan - Dapur</h1>
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 px-4 py-1.5 rounded-full border border-gray-300 text-xs font-semibold text-gray-700 bg-white">
                <svg class="w-4 h-4 text-[#D21F2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Kuah Kuwi</span>
            </div>

            <div class="w-9 h-9 rounded-full bg-[#D21F2B] text-white flex items-center justify-center font-bold text-xs shadow-sm">
                DP
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar Kiri (Marun Gelap serasi dengan Stock Dashboard & Owner) -->
        <aside class="w-60 bg-[#590D12] text-white flex flex-col justify-between py-6 px-4 shrink-0">
            <nav class="space-y-2">
                <a href="{{ route('dapur.stok') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-full {{ request()->routeIs('dapur.stok*') ? 'bg-[#D21F2B] text-white font-semibold shadow-md' : 'text-white/80 hover:bg-white/10 hover:text-white font-medium' }} text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('dapur.riwayat') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-full {{ request()->routeIs('dapur.riwayat*') ? 'bg-[#D21F2B] text-white font-semibold shadow-md' : 'text-white/80 hover:bg-white/10 hover:text-white font-medium' }} text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Riwayat</span>
                </a>

                <a href="javascript:void(0)" onclick="openDapurSettingModal()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 hover:text-white transition text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Setting</span>
                </a>
            </nav>

            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full py-2.5 rounded-full bg-[#D21F2B] hover:bg-[#b51924] text-white font-semibold text-sm shadow-md transition">
                    Logout
                </button>
            </form>
        </aside>

        <!-- Konten Tengah: Tabel Riwayat Pesanan Dapur -->
        <main class="flex-1 p-6 overflow-y-auto">
            <!-- Header & Ringkasan Harian -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-5">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Arsip Riwayat Pesanan Dapur</h2>
                    <p class="text-xs text-gray-500 mt-0.5">Catatan bukti pesanan masuk dari kasir beserta porsi & catatan khusus</p>
                </div>

                <div class="flex items-center gap-3">
                    <div class="bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">Order Hari Ini</span>
                        <span class="text-sm font-extrabold text-gray-900">{{ $pesananHariIni }} <span class="text-xs font-medium text-gray-500">Nota</span></span>
                    </div>
                    <div class="bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm">
                        <span class="block text-[10px] font-bold uppercase tracking-wider text-gray-400">Total Porsi Hari Ini</span>
                        <span class="text-sm font-extrabold text-[#D21F2B]">{{ $totalPorsiHariIni }} <span class="text-xs font-medium text-gray-500">Porsi</span></span>
                    </div>
                </div>
            </div>

            <!-- Bar Pencarian & Filter Tanggal/Bulan -->
            <form method="GET" action="{{ route('dapur.riwayat') }}"
                  class="w-full bg-white p-3.5 rounded-2xl border border-gray-200 shadow-sm mb-5 flex flex-wrap items-center justify-between gap-3">
                <div class="relative flex-1 min-w-[220px]">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nomor nota, meja, menu, atau catatan..."
                           class="w-full pl-10 pr-4 py-2 rounded-xl bg-gray-50 border border-gray-200 focus:bg-white focus:border-[#D21F2B] focus:outline-none text-xs transition">
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <input type="date" name="date" value="{{ request('date') }}" title="Filter Tanggal Spesifik"
                           class="text-xs border border-gray-200 bg-gray-50 focus:bg-white rounded-xl px-3 py-2 text-gray-700 focus:outline-none focus:border-[#D21F2B] transition">

                    <input type="month" name="month" value="{{ request('month') }}" title="Filter Bulan"
                           class="text-xs border border-gray-200 bg-gray-50 focus:bg-white rounded-xl px-3 py-2 text-gray-700 focus:outline-none focus:border-[#D21F2B] transition">

                    <button type="submit"
                            class="bg-[#D21F2B] hover:bg-[#b51924] text-white text-xs font-bold px-4 py-2 rounded-xl transition shadow-sm">
                        Filter
                    </button>

                    @if(request()->hasAny(['search', 'date', 'month']))
                        <a href="{{ route('dapur.riwayat') }}"
                           class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold px-3.5 py-2 rounded-xl border border-gray-200 transition">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            <!-- Tabel Daftar Riwayat Pesanan Dapur -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#590D12] text-white text-[11px] uppercase tracking-wider">
                                <th class="py-3.5 px-5 font-bold">Nota</th>
                                <th class="py-3.5 px-4 font-bold">Meja / Tipe</th>
                                <th class="py-3.5 px-4 font-bold">Waktu Masuk</th>
                                <th class="py-3.5 px-4 font-bold">Menu & Porsi</th>
                                <th class="py-3.5 px-4 font-bold">Catatan</th>
                                <th class="py-3.5 px-4 font-bold text-center">Bukti</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-xs">
                            @forelse($riwayatDapur as $trx)
                            @php
                                $totalPorsi = $trx->details->sum('quantity');
                            @endphp
                            <tr id="row-dapur-{{ $trx->id }}" class="dapur-row hover:bg-red-50/40 transition">
                                <td class="py-3.5 px-5 font-bold text-gray-900 whitespace-nowrap">
                                    {{ $trx->receipt_number }}
                                </td>
                                <td class="py-3.5 px-4 whitespace-nowrap">
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-50 text-[#D21F2B] border border-red-100">
                                        {{ $trx->table_number ?? 'Dine In' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-gray-500 whitespace-nowrap">
                                    <div class="font-semibold text-gray-700">{{ $trx->created_at->format('d/m/Y') }}</div>
                                    <div class="text-[11px] text-gray-400">{{ $trx->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-gray-800">
                                        {{ $totalPorsi }} Porsi
                                    </div>
                                    <div class="text-[11px] text-gray-500 line-clamp-1 max-w-[210px]">
                                        @foreach($trx->details as $d)
                                            {{ $d->product->name ?? 'Menu' }} ({{ $d->quantity }}x){{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    </div>
                                </td>
                                <td class="py-3.5 px-4 max-w-[160px]">
                                    @if($trx->note)
                                        <span class="inline-block bg-amber-50 border border-amber-200 text-amber-800 text-[11px] italic px-2.5 py-0.5 rounded-lg line-clamp-1">
                                            "{{ $trx->note }}"
                                        </span>
                                    @else
                                        <span class="text-gray-300 italic">-</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                    <button type="button" onclick='showDapurDetail(@json($trx))'
                                            class="bg-white border border-gray-200 hover:border-[#D21F2B] hover:text-[#D21F2B] text-gray-700 text-[11px] font-bold px-3 py-1.5 rounded-xl shadow-sm transition">
                                        Lihat Bukti
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-14 text-gray-400 italic text-xs">
                                    Belum ada arsip pesanan dapur yang sesuai dengan filter.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $riwayatDapur->links() }}
            </div>
        </main>

        <!-- Panel Kanan: Detail Bukti Struk Dapur (Tanpa Harga) -->
        <aside class="w-[340px] xl:w-[380px] bg-white p-6 border-l border-gray-200 shadow-sm flex flex-col justify-between shrink-0">
            <div class="overflow-y-auto pr-1">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                    <div>
                        <h2 class="text-base font-extrabold text-[#D21F2B]">Detail Bukti Dapur</h2>
                        <p class="text-[11px] text-gray-400">Kitchen Order Ticket (KOT)</p>
                    </div>
                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-red-50 text-[#D21F2B]">Kuah Kuwi</span>
                </div>

                <!-- Header Info Nota (Muncul saat pesanan dipilih) -->
                <div id="kot-meta" class="hidden bg-gray-50 border border-gray-200 rounded-xl p-3.5 mb-4 text-xs space-y-1.5">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Nomor Nota</span>
                        <span id="kot-receipt" class="font-extrabold text-gray-900">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Meja / Tipe</span>
                        <span id="kot-table" class="font-bold text-[#D21F2B]">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Waktu Masuk</span>
                        <span id="kot-time" class="font-semibold text-gray-800">-</span>
                    </div>
                </div>

                <!-- Daftar Menu & Jumlah Porsi -->
                <div id="kot-items-container" class="space-y-2.5 mb-4">
                    <div class="text-gray-400 text-center py-20 text-xs italic">
                        Klik tombol "Lihat Bukti" pada tabel di samping untuk memeriksa rincian pesanan dapur
                    </div>
                </div>

                <!-- Kotak Catatan Khusus Dapur -->
                <div id="kot-note-box" class="hidden bg-amber-50 border border-amber-200 rounded-xl p-3.5 mb-4">
                    <span class="block text-[10px] font-extrabold uppercase tracking-wider text-amber-800 mb-1">
                        Catatan Khusus Dapur:
                    </span>
                    <p id="kot-note-text" class="text-xs font-semibold text-amber-950 italic"></p>
                </div>
            </div>

            <!-- Footer Panel Kanan -->
            <div id="kot-footer" class="border-t border-dashed border-gray-200 pt-4 hidden">
                <div class="flex justify-between items-center text-xs text-gray-600 mb-3">
                    <span class="font-semibold">Total Item Dimasak</span>
                    <span id="kot-total-qty" class="text-sm font-extrabold text-[#D21F2B]">0 Porsi</span>
                </div>

                <button type="button" onclick="printKitchenProof()"
                        class="w-full flex items-center justify-center gap-2 bg-[#D21F2B] hover:bg-[#b51924] text-white font-bold py-3 rounded-xl transition shadow-md text-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    <span>Cetak Bukti Struk Dapur</span>
                </button>
            </div>
        </aside>
    </div>

    <!-- Modal Pengaturan Staff Dapur (Konsisten dengan Stok Dashboard) -->
    <div id="dapur-setting-modal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-[2px] items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6 relative">
            <div class="flex items-center justify-between border-b border-gray-100 pb-3.5 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-red-50 text-[#D21F2B] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-gray-900">Pengaturan Staff Dapur</h3>
                        <p class="text-[11px] text-gray-500">Preferensi manajemen stok & inventaris Kuah Kuwi</p>
                    </div>
                </div>
                <button type="button" onclick="closeDapurSettingModal()" class="text-gray-400 hover:text-gray-700 text-xl font-bold leading-none">&times;</button>
            </div>

            <div class="bg-gray-50 rounded-xl p-3.5 mb-4 border border-gray-100 text-xs space-y-1.5">
                <div class="flex justify-between">
                    <span class="text-gray-500">Petugas Dapur</span>
                    <span class="font-bold text-gray-900">{{ Auth::user()->name ?? 'Staff Dapur' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Divisi / Outlet</span>
                    <span class="font-bold text-[#D21F2B]">Dapur & Gudang • Kuah Kuwi</span>
                </div>
            </div>

            <div class="flex justify-end gap-2.5">
                <button type="button" onclick="closeDapurSettingModal()" class="px-4 py-2 rounded-xl border border-gray-300 text-xs font-bold text-gray-700 hover:bg-gray-50 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        let activeKitchenTrx = null;

        function formatWaktuIndo(isoString) {
            if (!isoString) return '-';
            const date = new Date(isoString);
            const pad = n => String(n).padStart(2, '0');
            return `${pad(date.getDate())}/${pad(date.getMonth() + 1)}/${date.getFullYear()} ${pad(date.getHours())}:${pad(date.getMinutes())} WIB`;
        }

        function showDapurDetail(trx) {
            activeKitchenTrx = trx;

            // Highlight baris yang dipilih
            document.querySelectorAll('.dapur-row').forEach(r => r.classList.remove('bg-red-50'));
            const activeRow = document.getElementById(`row-dapur-${trx.id}`);
            if (activeRow) activeRow.classList.add('bg-red-50');

            // Isi metadata nota
            document.getElementById('kot-receipt').textContent = trx.receipt_number || '-';
            document.getElementById('kot-table').textContent = trx.table_number || 'Dine In';
            document.getElementById('kot-time').textContent = formatWaktuIndo(trx.created_at);
            document.getElementById('kot-meta').classList.remove('hidden');

            // Isi daftar menu & jumlah porsi (tanpa harga)
            const container = document.getElementById('kot-items-container');
            container.innerHTML = '';
            let totalQty = 0;

            if (!trx.details || trx.details.length === 0) {
                container.innerHTML = `<div class="text-gray-400 text-center py-10 text-xs italic">Tidak ada item pesanan.</div>`;
            } else {
                trx.details.forEach(detail => {
                    const productName = detail.product ? detail.product.name : (detail.product_name || 'Menu');
                    const qty = Number(detail.quantity ?? 1);
                    totalQty += qty;

                    container.innerHTML += `
                        <div class="flex items-center justify-between bg-gray-50 px-3.5 py-2.5 rounded-xl border border-gray-100">
                            <span class="font-bold text-xs text-gray-800 pr-2">${productName}</span>
                            <span class="px-2.5 py-1 rounded-lg bg-[#590D12] text-white font-extrabold text-xs shrink-0">
                                ${qty}x
                            </span>
                        </div>
                    `;
                });
            }

            // Tampilkan catatan jika ada
            const noteBox = document.getElementById('kot-note-box');
            const noteText = document.getElementById('kot-note-text');
            if (trx.note && trx.note.trim() !== '') {
                noteText.textContent = `"${trx.note}"`;
                noteBox.classList.remove('hidden');
            } else {
                noteBox.classList.add('hidden');
            }

            document.getElementById('kot-total-qty').textContent = `${totalQty} Porsi`;
            document.getElementById('kot-footer').classList.remove('hidden');
        }

        // Cetak salinan Struk Dapur (KOT) langsung dari browser tanpa harga
        function printKitchenProof() {
            if (!activeKitchenTrx) return;

            const trx = activeKitchenTrx;
            const waktu = formatWaktuIndo(trx.created_at);
            let itemsHtml = '';

            (trx.details || []).forEach(detail => {
                const name = detail.product ? detail.product.name : (detail.product_name || 'Menu');
                const qty = detail.quantity ?? 1;
                itemsHtml += `
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:6px 0;border-bottom:1px dashed #ccc;font-size:13px;">
                        <span style="font-weight:700;">${name}</span>
                        <span style="font-weight:800;border:1px solid #111;padding:2px 6px;border-radius:4px;">${qty}x</span>
                    </div>
                `;
            });

            const noteHtml = (trx.note && trx.note.trim() !== '')
                ? `<div style="margin-top:10px;padding:8px;border:1px dashed #333;background:#fffbeb;font-size:12px;">
                        <strong>CATATAN DAPUR:</strong><br>
                        <em>"${trx.note}"</em>
                   </div>`
                : '';

            const printWin = window.open('', '_blank', 'width=380,height=600');
            printWin.document.write(`
                <html>
                <head>
                    <title>Struk Dapur - ${trx.receipt_number}</title>
                    <style>
                        body { font-family: 'Courier New', monospace; width: 280px; margin: 16px auto; color: #111; }
                        .center { text-align: center; }
                        .banner { background: #111; color: #fff; text-align: center; font-weight: bold; padding: 6px; margin: 10px 0; font-size: 12px; }
                    </style>
                </head>
                <body>
                    <div class="center">
                        <div style="font-size:11px;letter-spacing:1px;">ARSIP BUKTI DAPUR</div>
                        <div style="font-size:18px;font-weight:900;margin:2px 0;">STRUK DAPUR</div>
                        <div style="font-size:11px;">Kitchen Order Ticket • Kuah Kuwi</div>
                    </div>
                    <div class="banner">${(trx.table_number || 'DINE IN').toUpperCase()} • ${trx.receipt_number}</div>
                    <div style="font-size:11px;margin-bottom:8px;">Waktu Masuk: <strong>${waktu}</strong></div>
                    <div style="border-top:1px solid #111;border-bottom:1px solid #111;padding:4px 0;font-size:11px;font-weight:bold;display:flex;justify-content:space-between;">
                        <span>MENU PESANAN</span><span>JML</span>
                    </div>
                    ${itemsHtml}
                    ${noteHtml}
                    <div class="center" style="margin-top:14px;font-size:10px;color:#555;">
                        Dicetak ulang dari Arsip Riwayat Dapur
                    </div>
                </body>
                </html>
            `);
            printWin.document.close();
            printWin.focus();
            setTimeout(() => {
                printWin.print();
                printWin.close();
            }, 250);
        }

        function openDapurSettingModal() {
            const modal = document.getElementById('dapur-setting-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeDapurSettingModal() {
            const modal = document.getElementById('dapur-setting-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }
    </script>
</body>
</html>