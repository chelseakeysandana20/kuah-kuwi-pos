<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir.in - POS Kuah Kuwi</title>
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
            <div id="realtime-clock" class="bg-gray-50 border border-gray-200 px-3.5 py-1.5 rounded-full text-xs font-semibold text-gray-700 tracking-wide">
                --:--:-- --/--/----
            </div>
            <div class="w-9 h-9 rounded-full bg-[#D21F2B] text-white font-extrabold text-xs flex items-center justify-center shadow-sm shrink-0">
                KA
            </div>
        </div>
    </nav>

    <!-- Body Wrapper -->
    <div class="flex flex-1 overflow-hidden">
        
        <!-- Sidebar Kiri (Marun #4B090C seragam dengan Owner & Staf Dapur) -->
        <aside class="w-52 bg-[#4B090C] flex flex-col justify-between py-6 px-3.5 shadow-lg z-10 shrink-0">
            <div>
                <p class="px-4 text-[10px] font-bold uppercase tracking-widest text-white/45 mb-3">Kategori Menu</p>
                <div class="flex flex-col gap-2 w-full">
                    @foreach ($categories as $cat)
                        @php
                            $isActive = ($categoryId == $cat->id);
                        @endphp

                        <a href="{{ route('kasir.index', ['category_id' => $cat->id]) }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-full cursor-pointer transition-all duration-200 {{ $isActive ? 'bg-[#D21F2B] text-white font-bold shadow-lg translate-x-1.5' : 'text-white/75 font-medium hover:text-white hover:bg-white/10' }}">
                            
                            @if (strtolower($cat->name) == 'noodle')
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            @elseif (strtolower($cat->name) == 'gyoza')
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h6m-7 15h8a2 2 0 002-2V7a2 2 0 00-2-2H8a2 2 0 00-2 2v9a2 2 0 002 2z"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @endif

                            <span class="text-sm">{{ $cat->name }}</span>
                        </a>
                    @endforeach
                </div>

                <!-- Tombol Setting seragam dengan sidebar Owner & Dapur -->
                <div class="mt-4 pt-4 border-t border-white/10">
                    <button type="button" onclick="openSettingModal()" class="w-full flex items-center gap-3 px-4 py-3 rounded-full text-white/80 hover:text-white hover:bg-white/10 text-sm font-medium transition">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Setting</span>
                    </button>
                </div>
            </div>

            <!-- Tombol Tutup Kasir di bagian bawah sidebar (Pill Merah seperti tombol Logout Owner/Dapur) -->
            <div class="w-full">
                <button type="button" onclick="openTutupKasirModal()" class="w-full py-2.5 rounded-full bg-[#D21F2B] hover:bg-[#b51924] text-white text-sm font-bold transition shadow-md flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Tutup Kasir
                </button>
            </div>
        </aside>

        <!-- Area Konten Utama -->
        <main class="flex-1 p-6 overflow-y-auto">
            <div class="flex gap-6 max-w-7xl mx-auto h-full">
                
                <!-- Daftar Menu -->
                <div class="w-2/3">
                    <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-extrabold text-gray-900">Daftar Menu</h2>
                            <p class="text-xs text-gray-500 mt-0.5">Klik kartu menu untuk menambahkan ke pesanan pelanggan</p>
                        </div>
    
                        <!-- Input Search Bar -->
                        <div class="relative w-72">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" id="search-menu" class="bg-white border border-gray-200 text-gray-900 text-sm rounded-full focus:ring-[#D21F2B] focus:border-[#D21F2B] block w-full pl-10 pr-4 py-2 shadow-sm transition outline-none" placeholder="Cari menu..">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($products as $product)
                            <div onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})"
                                data-name="{{ strtolower($product->name) }}"
                                class="menu-item bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:border-[#D21F2B] hover:shadow-md cursor-pointer transition group flex flex-col justify-between">
                                <h3 class="font-bold text-base text-gray-800 group-hover:text-[#D21F2B] transition leading-snug">{{ $product->name }}</h3>
                                <p class="text-sm font-bold text-[#D21F2B] mt-3">
                                    {{ $product->price == 0 ? 'Gratis' : 'Rp ' . number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach

                        <!-- Pesan jika menu tidak ditemukan -->
                        <div id="empty-search-msg" class="hidden col-span-3 text-center py-10 text-gray-400 italic text-sm">
                            Menu tidak ditemukan.
                        </div>
                    </div>
                </div>

                <!-- Panel Keranjang (Detail Pesanan) -->
                <div class="w-1/3 bg-white p-5 rounded-2xl shadow-sm border border-gray-200 h-fit sticky top-0 flex flex-col">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                        <h2 class="text-lg font-extrabold text-[#D21F2B]">Detail pesanan</h2>
                        <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-red-50 text-[#D21F2B]">Kuah Kuwi</span>
                    </div>

                    <div class="flex items-center justify-between bg-gray-50 p-2.5 rounded-xl border border-gray-200 mb-4">
                        <span class="text-xs font-bold text-gray-700 pl-1">Tipe Pesanan:</span>
                        <select id="table_number" class="bg-white border border-gray-300 text-xs rounded-lg focus:ring-[#D21F2B] focus:border-[#D21F2B] block px-3 py-1.5 font-bold text-[#D21F2B] outline-none cursor-pointer">
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="Takeaway">Takeaway</option>
                            <option value="Dine In">Dine In</option>
                        </select>
                    </div>

                    <!-- Container Daftar Item di Keranjang -->
                    <div id="cart-items" class="space-y-3 max-h-[280px] overflow-y-auto pr-1 mb-4">
                        <div class="text-gray-400 text-center py-10 text-sm italic">
                            Belum ada menu yang dipilih
                        </div>
                    </div>

                    <!-- Kotak Tambah Catatan -->
                    <div class="mt-2 mb-3">
                        <textarea id="order_note" rows="2" 
                            class="w-full text-xs text-gray-700 border border-gray-200 rounded-xl focus:ring-[#D21F2B] focus:border-[#D21F2B] p-2.5 outline-none" 
                            placeholder="Tambah catatan pesanan (opsional)..."></textarea>
                    </div>

                    <!-- Total & Aksi Pembayaran -->
                    <div class="border-t border-dashed border-gray-200 pt-4 mt-auto">
                        <div class="flex justify-between text-xs text-gray-500 mb-2">
                            <span>Sub Total</span>
                            <span id="sub-total" class="font-bold text-gray-800">Rp 0</span>
                        </div>
                        <div class="flex justify-between font-extrabold text-lg text-gray-900 mb-5">
                            <span>Total</span>
                            <span id="total" class="text-[#D21F2B]">Rp 0</span>
                        </div>
                        
                        <div class="flex gap-3">
                            <button onclick="saveTicket()" class="w-1/2 bg-gray-100 border border-gray-300 text-gray-700 font-bold py-3 rounded-xl hover:bg-gray-200 transition text-sm">
                                Simpan
                            </button>
                            <button onclick="showConfirmModal()" class="w-1/2 bg-[#D21F2B] text-white font-bold py-3 rounded-xl hover:bg-[#b51924] transition shadow-md text-sm">
                                Bayar
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Modal Konfirmasi Pesanan -->
    <div id="confirm-modal" class="fixed inset-0 bg-black/50 backdrop-blur-[2px] hidden z-50 flex justify-center items-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative">
            
            <button onclick="closeConfirmModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-lg font-extrabold text-gray-900 mb-4 border-b border-gray-100 pb-3">Konfirmasi Pesanan</h2>

            <div class="mb-4">
                <span class="block text-xs font-bold text-gray-600 mb-1">Tipe Pesanan / Meja</span>
                <div id="modal-table-display" class="w-full border border-red-200 rounded-xl px-3.5 py-2 text-sm bg-red-50/50 font-bold text-[#D21F2B]">
                    -
                </div>
            </div>

            <div class="max-h-40 overflow-y-auto mb-4 pr-1">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-400 uppercase border-b border-gray-200 bg-white sticky top-0">
                        <tr>
                            <th class="py-2 font-medium">Menu</th>
                            <th class="py-2 text-center font-medium">Qty</th>
                            <th class="py-2 text-right font-medium">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="modal-cart-list" class="divide-y divide-gray-100"></tbody>
                </table>
            </div>

            <div id="modal-note-section" class="mb-4 hidden">
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-3">
                    <span class="block text-xs font-bold text-amber-800 mb-0.5">Catatan Pesanan:</span>
                    <span id="modal-note-display" class="text-xs text-amber-700 italic font-medium"></span>
                </div>
            </div>

            <div class="flex justify-between items-center border-t border-gray-200 pt-4 mb-4">
                <span class="text-gray-500 text-sm font-medium">Total Keseluruhan</span>
                <span class="font-extrabold text-2xl text-gray-900" id="modal-total-price">Rp 0</span>
            </div>

            <div class="mb-6">
                <p class="text-[11px] font-bold text-gray-400 text-center mb-2 uppercase tracking-wider">Metode Pembayaran</p>
                <div class="flex gap-3">
                    <button id="btn-cash" onclick="selectPayment('CASH')" class="w-1/2 bg-[#D21F2B] text-white font-bold py-2.5 rounded-xl border-2 border-[#D21F2B] transition shadow-sm text-sm">
                        CASH
                    </button>
                    <button id="btn-qris" onclick="selectPayment('QRIS')" class="w-1/2 bg-white text-gray-700 font-bold py-2.5 rounded-xl border-2 border-gray-200 hover:border-[#D21F2B] hover:text-[#D21F2B] transition shadow-sm text-sm">
                        QRIS
                    </button>
                </div>
            </div>

            <button onclick="processPayment()" class="w-full bg-[#1E7E34] hover:bg-[#176428] text-white font-bold py-3 rounded-xl transition shadow-md text-sm">
                Konfirmasi & Bayar
            </button>
        </div>
    </div>

    <!-- Modal Sukses Open Ticket -->
    <div id="success-modal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-[2px] flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl p-6 w-80 text-center transform transition-all">
            <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-[#1E7E34]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-lg font-extrabold text-gray-900 mb-1">Berhasil!</h3>
            <p class="text-xs text-gray-600 mb-5">Pesanan berhasil disimpan ke Open Ticket.</p>
            <button onclick="closeSuccessModal()" class="w-full bg-[#1E7E34] hover:bg-[#176428] text-white font-bold py-2.5 rounded-xl transition shadow-md text-sm">
                OK
            </button>
        </div>
    </div>

    <!-- Modal Tutup Kasir -->
    <div id="tutup-kasir-modal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-[2px] items-center justify-center p-4">
        <div class="bg-white w-full max-w-[660px] rounded-2xl shadow-2xl px-8 py-7 relative">
            <div class="text-center mb-5">
                <div class="w-12 h-12 rounded-full bg-red-50 border-2 border-[#D21F2B] text-[#D21F2B] flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-lg font-extrabold text-gray-900">Penjualan Hari Ini Selesai!</h2>
                <p class="text-[11px] text-gray-500 mt-1 leading-relaxed">
                    Terima Kasih Telah Menggunakan Kasir.In Untuk Mendukung Usahamu<br>
                    Berikut Rekap Dan Laporan Penjualan Hari Ini
                </p>
            </div>

            <div class="bg-[#4B090C] text-white rounded-xl px-5 py-3.5 flex flex-wrap items-center justify-between gap-4 mb-5 shadow-sm">
                <div class="text-center">
                    <p class="text-[11px] font-medium text-white/70">ID Report</p>
                    <p id="rekap-report-id" class="text-xs font-bold mt-0.5">{{ $rekapHariIni['report_id'] ?? 'RPT' . date('dmY') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-[11px] font-medium text-white/70">Tanggal</p>
                    <p id="rekap-tanggal" class="text-xs font-bold mt-0.5">{{ $rekapHariIni['tanggal'] ?? date('d F Y') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-[11px] font-medium text-white/70">Total Income</p>
                    <p id="rekap-total-income" class="text-xs font-extrabold text-amber-300 mt-0.5">Rp {{ number_format($rekapHariIni['total_income'] ?? 0, 0, ',', '.') }}</p>
                </div>
                <a href="{{ route('kasir.tutup.download') }}" class="bg-[#D21F2B] hover:bg-[#b51924] text-white text-xs font-bold px-4 py-2 rounded-lg transition shadow-sm">
                    Download Report
                </a>
            </div>

            <div class="border border-gray-200 rounded-2xl p-5 mb-6">
                <h3 class="text-sm font-extrabold text-gray-900 mb-3.5">Rekap Penjualan</h3>
                <div class="space-y-2.5 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 font-medium">Status Toko</span>
                        <span class="font-bold text-gray-900 flex items-center gap-1.5">
                            Selesai / Tutup Warung
                            <span class="w-2.5 h-2.5 rounded-full bg-[#1E7E34] inline-block"></span>
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 font-medium">Total Transaksi</span>
                        <span id="rekap-total-transaksi" class="font-bold text-gray-900">{{ $rekapHariIni['total_transaksi'] ?? 0 }} Transaksi</span>
                    </div>
                    <div class="pt-1">
                        <p class="text-gray-600 font-medium mb-2">Rincian Pendapatan</p>
                        <div class="space-y-2 pl-1">
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-gray-700 font-medium">
                                    <span class="w-5 h-5 rounded bg-green-100 text-green-700 flex items-center justify-center text-[11px]">💵</span>
                                    Pendapatan Cash
                                </span>
                                <span id="rekap-total-cash" class="font-bold text-gray-900">Rp {{ number_format($rekapHariIni['total_cash'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="flex items-center gap-2 text-gray-700 font-medium">
                                    <span class="w-5 h-5 rounded bg-red-100 text-[#D21F2B] flex items-center justify-center text-[11px]">📱</span>
                                    Pendapatan QRIS
                                </span>
                                <span id="rekap-total-qris" class="font-bold text-gray-900">Rp {{ number_format($rekapHariIni['total_qris'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 relative">
                    <label class="absolute -top-2 left-3 bg-white px-1 text-[10px] font-bold text-gray-500">Catatan Hari Ini</label>
                    <textarea id="catatan-tutup-kasir" rows="2" placeholder="Tulis catatan operasional, kendala, atau keterangan selisih kas hari ini (opsional)..." class="w-full border border-gray-300 rounded-xl px-3.5 py-2.5 text-xs text-gray-700 focus:outline-none focus:border-[#D21F2B] resize-none"></textarea>
                </div>
            </div>

            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="closeTutupKasirModal()" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 text-xs font-bold hover:bg-gray-50 transition">
                    Batal Tutup Kasir
                </button>
                <form action="{{ route('kasir.tutup.konfirmasi') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#D21F2B] hover:bg-[#b51924] text-white text-xs font-extrabold transition shadow-sm">
                        Konfirmasi Tutup Kasir
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom Toast Notification (Tengah Header) -->
    <div id="custom-toast"
        class="fixed top-4 left-1/2 -translate-x-1/2 z-[100] hidden items-center gap-3.5 bg-white border-l-4 border-[#D21F2B] shadow-2xl rounded-2xl px-5 py-3.5 min-w-[320px] max-w-md transition-all duration-300 opacity-0 -translate-y-4">
        <div id="toast-icon-wrapper" class="w-9 h-9 rounded-full bg-red-50 text-[#D21F2B] flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
            </svg>
        </div>
        <div class="flex-1">
            <p id="toast-title" class="text-xs font-extrabold text-gray-900">Perhatian</p>
            <p id="toast-message" class="text-[11px] font-medium text-gray-600 mt-0.5 leading-snug">
                Silakan pilih Tipe Pesanan/Meja terlebih dahulu di detail pesanan!
            </p>
        </div>
        <button type="button" onclick="hideCustomToast()" class="text-gray-400 hover:text-gray-700 text-lg font-bold leading-none px-1">
            &times;
        </button>
    </div>

    <!-- Modal Pengaturan POS -->
    <div id="setting-modal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-[2px] items-center justify-center p-4">
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
                        <h3 class="text-sm font-extrabold text-gray-900">Pengaturan Kasir</h3>
                        <p class="text-[11px] text-gray-500">Preferensi operasional POS Kuah Kuwi</p>
                    </div>
                </div>
                <button type="button" onclick="closeSettingModal()" class="text-gray-400 hover:text-gray-700 text-xl font-bold leading-none">&times;</button>
            </div>

            <div class="bg-gray-50 rounded-xl p-3.5 mb-4 border border-gray-100 text-xs space-y-1.5">
                <div class="flex justify-between">
                    <span class="text-gray-500">Kasir Bertugas</span>
                    <span class="font-bold text-gray-900">{{ Auth::user()->name ?? 'Kasir Kuah Kuwi' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Outlet / Platform</span>
                    <span class="font-bold text-[#D21F2B]">Kuah Kuwi • kasir.in</span>
                </div>
            </div>

            <div class="space-y-3 mb-6">
                <label class="flex items-center justify-between p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition">
                    <div>
                        <p class="text-xs font-bold text-gray-800">Otomatis Cetak / Buka Struk</p>
                        <p class="text-[11px] text-gray-500">Buka tab struk otomatis setelah pembayaran selesai</p>
                    </div>
                    <input type="checkbox" id="setting-auto-struk" checked class="w-4 h-4 accent-[#D21F2B] rounded cursor-pointer">
                </label>

                <label class="flex items-center justify-between p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition">
                    <div>
                        <p class="text-xs font-bold text-gray-800">Metode Bayar Default</p>
                        <p class="text-[11px] text-gray-500">Pilihan awal saat membuka transaksi baru</p>
                    </div>
                    <select id="setting-default-payment" class="text-xs font-bold text-gray-800 border border-gray-300 rounded-lg px-2.5 py-1.5 focus:outline-none focus:border-[#D21F2B]">
                        <option value="CASH">CASH</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </label>
            </div>

            <div class="flex justify-end gap-2.5">
                <button type="button" onclick="closeSettingModal()" class="px-4 py-2 rounded-xl border border-gray-300 text-xs font-bold text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="button" onclick="savePosSettings()" class="px-5 py-2 rounded-xl bg-[#D21F2B] hover:bg-[#b51924] text-white text-xs font-bold transition shadow-sm">
                    Simpan Pengaturan
                </button>
            </div>
        </div>
    </div>

    <!-- Script JavaScript untuk Keranjang & Jam Real-time -->
    <script>
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const date = now.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
            document.getElementById('realtime-clock').innerText = `${time}  ${date}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        let cart = [];

        function addToCart(id, name, price) {
            const existingItem = cart.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }
            renderCart();
        }

        function changeQuantity(id, amount) {
            const item = cart.find(item => item.id === id);
            if (item) {
                item.quantity += amount;
                if (item.quantity <= 0) {
                    cart = cart.filter(i => i.id !== id);
                }
            }
            renderCart();
        }

        function formatRupiah(angka) {
            return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function renderCart() {
            const cartContainer = document.getElementById('cart-items');
            const subTotalEl = document.getElementById('sub-total');
            const totalEl = document.getElementById('total');
            
            cartContainer.innerHTML = '';

            if (cart.length === 0) {
                cartContainer.innerHTML = `
                    <div class="text-gray-400 text-center py-10 text-sm italic">
                        Belum ada menu yang dipilih
                    </div>
                `;
                subTotalEl.innerText = formatRupiah(0);
                totalEl.innerText = formatRupiah(0);
                return;
            }

            let subtotal = 0;

            cart.forEach(item => {
                subtotal += item.price * item.quantity;

                const itemEl = document.createElement('div');
                itemEl.className = 'flex justify-between items-center bg-gray-50 p-3 rounded-xl border border-gray-100';
                itemEl.innerHTML = `
                    <div class="flex-1 pr-2">
                        <h4 class="font-bold text-sm text-gray-800">${item.name}</h4>
                        <p class="text-xs text-gray-400">${formatRupiah(item.price)}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="changeQuantity(${item.id}, -1)" class="w-7 h-7 bg-gray-200 text-gray-700 font-bold rounded-lg flex items-center justify-center hover:bg-gray-300">-</button>
                        <span class="text-sm font-bold w-5 text-center">${item.quantity}</span>
                        <button onclick="changeQuantity(${item.id}, 1)" class="w-7 h-7 bg-[#D21F2B] text-white font-bold rounded-lg flex items-center justify-center hover:bg-[#b51924]">+</button>
                    </div>
                `;
                cartContainer.appendChild(itemEl);
            });

            subTotalEl.innerText = formatRupiah(subtotal);
            totalEl.innerText = formatRupiah(subtotal);
        }

        let selectedPaymentMethod = 'CASH';

        function selectPayment(method) {
            selectedPaymentMethod = method;
            const btnCash = document.getElementById('btn-cash');
            const btnQris = document.getElementById('btn-qris');

            if (method === 'CASH') {
                btnCash.className = "w-1/2 bg-[#D21F2B] text-white font-bold py-2.5 rounded-xl border-2 border-[#D21F2B] transition shadow-sm text-sm";
                btnQris.className = "w-1/2 bg-white text-gray-700 font-bold py-2.5 rounded-xl border-2 border-gray-200 hover:border-[#D21F2B] hover:text-[#D21F2B] transition shadow-sm text-sm";
            } else {
                btnQris.className = "w-1/2 bg-[#D21F2B] text-white font-bold py-2.5 rounded-xl border-2 border-[#D21F2B] transition shadow-sm text-sm";
                btnCash.className = "w-1/2 bg-white text-gray-700 font-bold py-2.5 rounded-xl border-2 border-gray-200 hover:border-[#D21F2B] hover:text-[#D21F2B] transition shadow-sm text-sm";
            }
        }

        function saveTicket() {
            if (cart.length === 0) {
                showCustomToast('Keranjang masih kosong! Silakan pilih menu terlebih dahulu.');
                return;
            }

            let tableElement = document.getElementById('table_number');
            let tableNumber = tableElement ? tableElement.value : '';

            if (!tableNumber) {
                showCustomToast('Silakan pilih Tipe Pesanan/Meja terlebih dahulu di panel detail pesanan!');
                if (tableElement) tableElement.focus();
                return;
            }

            let noteInput = document.getElementById('order_note') ? document.getElementById('order_note').value : '';

            fetch("{{ route('kasir.checkout') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    items: cart, 
                    note: noteInput,
                    table_number: tableNumber,
                    status: 'saved',
                    payment_method: null 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('success-modal').classList.remove('hidden');
                } else {
                    showCustomToast('Gagal menyimpan: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error detail:', error);
                showCustomToast('Terjadi kesalahan sistem.');
            });
        }

        function closeSuccessModal() {
            document.getElementById('success-modal').classList.add('hidden');
            cart = [];
            if (typeof renderCart === 'function') renderCart();
            location.reload();
        }

        function processPayment() {
            if (cart.length === 0) {
                showCustomToast('Keranjang masih kosong! Silakan pilih menu terlebih dahulu.');
                return;
            }

            let noteElement = document.getElementById('order_note');
            let noteValue = noteElement ? noteElement.value : '';
            
            let tableElement = document.getElementById('table_number');
            let tableValue = tableElement ? tableElement.value : '';

            fetch("{{ route('kasir.checkout') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 
                    items: cart, 
                    note: noteValue,
                    payment_method: selectedPaymentMethod,
                    table_number: tableValue
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeConfirmModal();
                    cart = [];
                    if (typeof renderCart === 'function') {
                        renderCart();
                    }
                    if (noteElement) noteElement.value = ''; 
                    if (tableElement) tableElement.value = '';
                    
                    if (data.transaction_id) {
                        window.open('/kasir/struk/' + data.transaction_id, '_blank');
                    }
                } else {
                    showCustomToast('Gagal: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error detail:', error);
                showCustomToast('Terjadi kesalahan JavaScript: ' + error.message);
            });
        }

        function showConfirmModal() {
            if (cart.length === 0) {
                showCustomToast('Keranjang masih kosong! Silakan pilih menu terlebih dahulu.');
                return;
            }

            let tableSelect = document.getElementById('table_number');
            let selectedTable = tableSelect.value;

            if (!selectedTable) {
                showCustomToast('Silakan pilih Tipe Pesanan/Meja terlebih dahulu di detail pesanan!');
                tableSelect.focus();
                return; 
            }

            document.getElementById('modal-table-display').innerText = selectedTable;

            let modalList = document.getElementById('modal-cart-list');
            let modalTotal = document.getElementById('modal-total-price');
            let total = 0;
            
            modalList.innerHTML = ''; 

            cart.forEach(item => {
                let subtotal = item.price * item.quantity;
                total += subtotal;

                modalList.innerHTML += `
                    <tr>
                        <td class="py-3 font-medium text-gray-800">${item.name}</td>
                        <td class="py-3 text-center text-gray-600">${item.quantity}</td>
                        <td class="py-3 text-right font-medium text-gray-800">Rp ${subtotal.toLocaleString('id-ID')}</td>
                    </tr>
                `;
            });

            let noteInput = document.getElementById('order_note').value;
            let noteSection = document.getElementById('modal-note-section');
            let noteDisplay = document.getElementById('modal-note-display');

            if (noteSection && noteDisplay) {
                if (noteInput.trim() !== '') {
                    noteDisplay.innerText = noteInput;
                    noteSection.classList.remove('hidden');
                } else {
                    noteSection.classList.add('hidden');
                }
            }

            modalTotal.innerHTML = `Rp ${total.toLocaleString('id-ID')}`;
            document.getElementById('confirm-modal').classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirm-modal').classList.add('hidden');
        }

        const searchInput = document.getElementById('search-menu');
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();
                const menuItems = document.querySelectorAll('.menu-item');
                const emptyMsg = document.getElementById('empty-search-msg');
                let visibleCount = 0;

                menuItems.forEach(item => {
                    const menuName = item.getAttribute('data-name') || '';
                    if (menuName.includes(keyword)) {
                        item.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        item.classList.add('hidden');
                    }
                });

                if (emptyMsg) {
                    if (visibleCount === 0 && menuItems.length > 0) {
                        emptyMsg.classList.remove('hidden');
                    } else {
                        emptyMsg.classList.add('hidden');
                    }
                }
            });
        }

        function openTutupKasirModal() {
            const modal = document.getElementById('tutup-kasir-modal');
            if (!modal) return;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.style.display = 'flex';

            fetch('/kasir/rekap-hari-ini')
                .then(res => res.json())
                .then(data => {
                    const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
                    set('rekap-report-id', data.report_id);
                    set('rekap-tanggal', data.tanggal);
                    set('rekap-total-income', 'Rp ' + Number(data.total_income || 0).toLocaleString('id-ID'));
                    set('rekap-total-transaksi', (data.total_transaksi || 0) + ' Transaksi');
                    set('rekap-total-cash', 'Rp ' + Number(data.total_cash || 0).toLocaleString('id-ID'));
                    set('rekap-total-qris', 'Rp ' + Number(data.total_qris || 0).toLocaleString('id-ID'));
                })
                .catch(err => console.error('Gagal fetch rekap:', err));
        }

        function closeTutupKasirModal() {
            const modal = document.getElementById('tutup-kasir-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.style.display = 'none';
            }
        }

        let toastTimeout;

        function showCustomToast(message, title = 'Perhatian', type = 'warning') {
            const toast = document.getElementById('custom-toast');
            const toastTitle = document.getElementById('toast-title');
            const toastMessage = document.getElementById('toast-message');
            const iconWrapper = document.getElementById('toast-icon-wrapper');

            toastTitle.textContent = title;
            toastMessage.textContent = message;

            if (type === 'success') {
                toast.classList.remove('border-[#D21F2B]');
                toast.classList.add('border-[#1E7E34]');
                iconWrapper.className = 'w-9 h-9 rounded-full bg-green-50 text-[#1E7E34] flex items-center justify-center shrink-0';
            } else {
                toast.classList.remove('border-[#1E7E34]');
                toast.classList.add('border-[#D21F2B]');
                iconWrapper.className = 'w-9 h-9 rounded-full bg-red-50 text-[#D21F2B] flex items-center justify-center shrink-0';
            }

            toast.classList.remove('hidden');
            toast.classList.add('flex');
            requestAnimationFrame(() => {
                toast.classList.remove('opacity-0', '-translate-y-4');
                toast.classList.add('opacity-100', 'translate-y-0');
            });

            clearTimeout(toastTimeout);
            toastTimeout = setTimeout(() => {
                hideCustomToast();
            }, 3000);
        }

        function hideCustomToast() {
            const toast = document.getElementById('custom-toast');
            toast.classList.remove('opacity-100', 'translate-y-0');
            toast.classList.add('opacity-0', '-translate-y-4');
            setTimeout(() => {
                toast.classList.add('hidden');
                toast.classList.remove('flex');
            }, 300);
        }

        function openSettingModal() {
            const modal = document.getElementById('setting-modal');
            if (!modal) return;

            const autoStruk = localStorage.getItem('pos_auto_struk');
            const defaultPay = localStorage.getItem('pos_default_payment') || 'CASH';

            document.getElementById('setting-auto-struk').checked = autoStruk !== 'false';
            document.getElementById('setting-default-payment').value = defaultPay;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.style.display = 'flex';
        }

        function closeSettingModal() {
            const modal = document.getElementById('setting-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modal.style.display = 'none';
            }
        }

        function savePosSettings() {
            const autoStruk = document.getElementById('setting-auto-struk').checked;
            const defaultPay = document.getElementById('setting-default-payment').value;

            localStorage.setItem('pos_auto_struk', autoStruk);
            localStorage.setItem('pos_default_payment', defaultPay);

            if (typeof selectPayment === 'function') {
                selectPayment(defaultPay);
            }

            closeSettingModal();
            if (typeof showCustomToast === 'function') {
                showCustomToast('Pengaturan kasir berhasil disimpan!', 'Berhasil', 'success');
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const savedPay = localStorage.getItem('pos_default_payment');
            if (savedPay && typeof selectPayment === 'function') {
                selectPayment(savedPay);
            }
        });
    </script>
</body>
</html>