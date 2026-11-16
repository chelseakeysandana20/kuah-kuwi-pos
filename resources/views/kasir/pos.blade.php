<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir.in - POS Kuah Kuwi</title>
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
            <div id="realtime-clock" class="bg-gray-100 px-4 py-2 rounded-full text-sm font-semibold text-gray-700 tracking-wide">
                --:--:-- --/--/----
            </div>
            <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden border border-gray-200">
                <img src="https://ui-avatars.com/api/?name=Kasir&background=random" alt="Profil Kasir" class="w-full h-full object-cover">
            </div>
        </div>
    </nav>

    <!-- Body Wrapper -->
    <div class="flex flex-1 overflow-hidden">
        
        <!-- Sidebar Kiri -->
        <aside class="w-24 bg-white border-r flex flex-col justify-between py-6 items-center shadow-sm z-0 shrink-0">
            <div class="flex flex-col gap-4 w-full px-3">
            @foreach ($categories as $cat)
                @php
                    $isActive = ($categoryId == $cat->id);
                @endphp

                <a href="{{ route('kasir.index', ['category_id' => $cat->id]) }}" 
                   class="flex flex-col items-center justify-center p-3 rounded-2xl cursor-pointer transition {{ $isActive ? 'bg-red-50 text-red-600 border border-red-200 shadow-sm' : 'text-gray-400 hover:text-gray-700 hover:bg-gray-50' }}">
                    
                    @if (strtolower($cat->name) == 'noodle')
                        <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    @elseif (strtolower($cat->name) == 'gyoza')
                        <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h6m-7 15h8a2 2 0 002-2V7a2 2 0 00-2-2H8a2 2 0 00-2 2v9a2 2 0 002 2z"></path>
                        </svg>
                    @else
                        <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    @endif

                    <span class="text-xs {{ $isActive ? 'font-bold' : 'font-semibold' }}">{{ $cat->name }}</span>
                </a>
                @endforeach
            </div>

            <div class="flex flex-col gap-3 w-full px-3">
                <button class="w-full bg-gray-400 text-white py-2 rounded-md text-xs font-bold flex flex-col items-center justify-center gap-1 hover:bg-gray-500 transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Setting
                </button>
                
                <button type="button" onclick="openTutupKasirModal()" class="w-full bg-yellow-400 text-white py-3 rounded-md text-xs font-bold hover:bg-yellow-500 transition shadow-sm">
                    Tutup Kasir
                </button>
                    </div>
                </aside>

        <!-- Area Konten Utama -->
        <main class="flex-1 p-6 overflow-y-auto">
            <div class="flex gap-6 max-w-7xl mx-auto h-full">
                
                <!-- Daftar Menu -->
                <div class="w-2/3">
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-gray-800">Daftar Menu</h2>
    
                        <!-- Input Search Bar -->
                        <div class="relative w-72">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" id="search-menu" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2.5 shadow-sm transition" placeholder="Cari menu..">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($products as $product)
                            <div onclick="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})"
                                data-name="{{ strtolower($product->name) }}"
                                class="menu-item bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-red-500 cursor-pointer transition group">
                                <h3 class="font-bold text-lg text-gray-800 group-hover:text-red-600 transition">{{ $product->name }}</h3>
                                <p class="text-sm font-semibold text-gray-400 mt-1">
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
                <div class="w-1/3 bg-white p-5 rounded-xl shadow-sm border border-gray-200 h-fit sticky top-0 flex flex-col">
                    <h2 class="text-lg font-bold text-blue-800 border-b pb-3 mb-4">Detail pesanan</h2>
                    <div class="flex items-center justify-between bg-gray-50 p-2.5 rounded-lg border border-gray-200 shadow-sm mb-4">
                        <span class="text-sm font-semibold text-gray-700">Tipe:</span>
                        <!-- ID 'table_number' ini wajib ada agar script JS bisa mengambil nilainya saat tombol Simpan ditekan -->
                        <select id="table_number" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block p-1.5 font-bold text-blue-800 outline-none cursor-pointer">
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

                    <!-- Kotak Tambah Catatan (Sisipkan di sini) -->
                    <div class="mt-3 mb-3">
                        <textarea id="order_note" rows="2" 
                            class="w-full text-xs text-gray-700 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 p-2" 
                            placeholder="Tambah catatan pesanan (opsional)..."></textarea>
                    </div>

                    <!-- Total & Aksi Pembayaran -->
                    <div class="border-t border-dashed pt-4 mt-auto">
                        <div class="flex justify-between text-sm text-gray-500 mb-2">
                            <span>Sub Total</span>
                            <span id="sub-total" class="font-bold text-gray-800">Rp 0</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg text-gray-800 mb-6">
                            <span>Total</span>
                            <span id="total">Rp 0</span>
                        </div>
                        
                        <div class="flex gap-3">
                            <button onclick="saveTicket()" class="w-1/2 bg-gray-400 text-white font-bold py-3 rounded-lg hover:bg-gray-500 transition shadow-sm">
                                Simpan
                            </button>
                            <!-- Ini tombol bayarnya yang diubah -->
                            <button onclick="showConfirmModal()" class="w-1/2 bg-red-600 text-white font-bold py-3 rounded-lg hover:bg-red-700 transition shadow-md">
                            Bayar
                        </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Modal Konfirmasi Pesanan -->
    <div id="confirm-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex justify-center items-center">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative">
            
            <!-- Tombol Silang -->
            <button onclick="closeConfirmModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-100 pb-3">Konfirmasi Pesanan</h2>

            <!-- Tipe Pesanan / Nomor Meja (Dropdown Otomatis) -->
            <div class="mb-4">
                <span class="block text-sm font-medium text-gray-700 mb-1">Tipe Pesanan / Meja</span>
                <!-- Elemen teks ini akan diisi otomatis oleh JavaScript -->
                <div id="modal-table-display" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-gray-100 font-bold text-gray-800">
                    -
                </div>
            </div>

            <!-- Tabel Daftar Pesanan -->
            <div class="max-h-40 overflow-y-auto mb-4 pr-1">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-400 uppercase border-b border-gray-200 bg-white sticky top-0">
                        <tr>
                            <th class="py-2 font-medium">Menu</th>
                            <th class="py-2 text-center font-medium">Qty</th>
                            <th class="py-2 text-right font-medium">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="modal-cart-list" class="divide-y divide-gray-100">
                        <!-- Data pesanan -->
                    </tbody>
                </table>
            </div>

            <!-- KOTAK CATATAN DITARUH DI SINI -->
            <div id="modal-note-section" class="mb-4 hidden">
                <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-3 shadow-sm">
                    <span class="block text-xs font-bold text-yellow-800 mb-1">Catatan Pesanan:</span>
                    <span id="modal-note-display" class="text-sm text-yellow-700 italic font-medium"></span>
                </div>
            </div>

            <!-- Total Harga -->
            <div class="flex justify-between items-center border-t border-gray-200 pt-4 mb-4">
                <span class="text-gray-500 font-medium">Total Keseluruhan</span>
                <span class="font-bold text-2xl text-gray-900" id="modal-total-price">Rp 0</span>
            </div>

            <!-- Pilihan Metode Pembayaran (Berfungsi sebagai Toggle) -->
            <div class="mb-6">
                <p class="text-xs font-medium text-gray-400 text-center mb-2 uppercase tracking-wider">Metode Pembayaran</p>
                <div class="flex gap-3">
                    <!-- Secara default Cash aktif (Merah) -->
                    <button id="btn-cash" onclick="selectPayment('CASH')" class="w-1/2 bg-red-600 text-white font-bold py-2 rounded-xl border-2 border-red-600 transition shadow-sm">
                        CASH
                    </button>
                    <!-- Secara default QRIS tidak aktif (Putih bergaris abu) -->
                    <button id="btn-qris" onclick="selectPayment('QRIS')" class="w-1/2 bg-white text-gray-700 font-bold py-2 rounded-xl border-2 border-gray-200 hover:border-red-600 hover:text-red-600 transition shadow-sm">
                        QRIS
                    </button>
                </div>
            </div>

            <!-- Tombol Eksekusi Utama -->
            <button onclick="processPayment()" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition shadow-md">
                Konfirmasi & Bayar
            </button>
        </div>
    </div>

    <!-- Modal Sukses Open Ticket -->
    <div id="success-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-xl p-6 w-80 text-center transform transition-all">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Berhasil!</h3>
            <p class="text-sm text-gray-600 mb-6">Pesanan berhasil disimpan ke Open tiket.</p>
            <button onclick="closeSuccessModal()" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 rounded-xl transition shadow-md">
                OK
            </button>
        </div>
    </div>

    <!-- Modal Tutup Kasir (Penjualan Hari Ini Selesai) -->
    <div id="tutup-kasir-modal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-[2px] items-center justify-center p-4">
        <div class="bg-white w-full max-w-[660px] rounded-2xl shadow-2xl px-8 py-7 relative animate-fadeIn">

            <!-- Header Ikon Centang Kuning & Judul -->
            <div class="text-center mb-5">
                <div class="w-12 h-12 rounded-full bg-amber-50 border-2 border-[#E5B822] text-[#E5B822] flex items-center justify-center mx-auto mb-3">
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

            <!-- Banner Kuning Ringkasan Utama & Tombol Download Report -->
            <div class="bg-[#E5C14A] rounded-xl px-5 py-3.5 flex flex-wrap items-center justify-between gap-4 mb-5 shadow-sm">
                <div class="text-center">
                    <p class="text-[11px] font-bold text-gray-900">ID report</p>
                    <p id="rekap-report-id" class="text-xs font-medium text-gray-800 mt-0.5">{{ $rekapHariIni['report_id'] ?? 'RPT' . date('dmY') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-[11px] font-bold text-gray-900">Tanggal</p>
                    <p id="rekap-tanggal" class="text-xs font-medium text-gray-800 mt-0.5">{{ $rekapHariIni['tanggal'] ?? date('d F Y') }}</p>
                </div>
                <div class="text-center">
                    <p class="text-[11px] font-bold text-gray-900">Total Income</p>
                    <p id="rekap-total-income" class="text-xs font-extrabold text-gray-900 mt-0.5">Rp {{ number_format($rekapHariIni['total_income'] ?? 0, 0, ',', '.') }}</p>
                </div>
                <a href="{{ route('kasir.tutup.download') }}" class="bg-[#1E7E34] hover:bg-[#176428] text-white text-xs font-bold px-4 py-2 rounded-lg transition shadow-sm">
                    Download Report
                </a>
            </div>

            <!-- Kotak Rekap Penjualan -->
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
                                    <span class="w-5 h-5 rounded bg-amber-100 text-amber-700 flex items-center justify-center text-[11px]">📱</span>
                                    Pendapatan QRIS
                                </span>
                                <span id="rekap-total-qris" class="font-bold text-gray-900">Rp {{ number_format($rekapHariIni['total_qris'] ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catatan Hari Ini -->
                <div class="mt-4 relative">
                    <label class="absolute -top-2 left-3 bg-white px-1 text-[10px] font-bold text-gray-500">Catatan Hari Ini</label>
                    <textarea id="catatan-tutup-kasir" rows="2" placeholder="Tulis catatan operasional, kendala, atau keterangan selisih kas hari ini (opsional)..." class="w-full border border-gray-300 rounded-xl px-3.5 py-2.5 text-xs text-gray-700 focus:outline-none focus:border-[#E5C14A] resize-none"></textarea>
                </div>
            </div>

            <!-- Tombol Aksi Bawah -->
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="closeTutupKasirModal()" class="px-6 py-2.5 rounded-xl border border-[#E5C14A] text-gray-800 text-xs font-bold hover:bg-amber-50 transition">
                    Batal Tutup Kasir
                </button>
                <form action="{{ route('kasir.tutup.konfirmasi') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#E5C14A] hover:bg-[#d6b13a] text-gray-900 text-xs font-extrabold transition shadow-sm">
                        Konfirmasi Tutup Kasir
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom Toast Notification (kasir.in Theme) -->
    <div id="custom-toast"
        class="fixed top-6 left-1/2 -translate-x-1/2 z-[100] hidden items-center gap-3.5 bg-white border-l-4 border-[#D21F2B] shadow-2xl rounded-2xl px-5 py-3.5 min-w-[320px] max-w-md transition-all duration-300 opacity-0 -translate-y-4">
        <!-- Ikon Peringatan -->
        <div id="toast-icon-wrapper" class="w-9 h-9 rounded-full bg-red-50 text-[#D21F2B] flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
            </svg>
        </div>

        <!-- Teks Judul & Pesan -->
        <div class="flex-1">
            <p id="toast-title" class="text-xs font-extrabold text-gray-900">Perhatian</p>
            <p id="toast-message" class="text-[11px] font-medium text-gray-600 mt-0.5 leading-snug">
                Silakan pilih Tipe Pesanan/Meja terlebih dahulu di detail pesanan!
            </p>
        </div>

        <!-- Tombol Tutup Manual -->
        <button type="button" onclick="hideCustomToast()" class="text-gray-400 hover:text-gray-700 text-lg font-bold leading-none px-1">
            &times;
        </button>
    </div>
    <!-- Script JavaScript untuk Keranjang & Jam Real-time -->
    <script>
        // Jam Real-time
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const date = now.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
            document.getElementById('realtime-clock').innerText = `${time}  ${date}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Logika Keranjang Belanja (POS Cart)
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
                itemEl.className = 'flex justify-between items-center bg-gray-50 p-3 rounded-lg border border-gray-100';
                itemEl.innerHTML = `
                    <div class="flex-1 pr-2">
                        <h4 class="font-bold text-sm text-gray-800">${item.name}</h4>
                        <p class="text-xs text-gray-400">${formatRupiah(item.price)}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="changeQuantity(${item.id}, -1)" class="w-7 h-7 bg-gray-200 text-gray-700 font-bold rounded flex items-center justify-center hover:bg-gray-300">-</button>
                        <span class="text-sm font-bold w-5 text-center">${item.quantity}</span>
                        <button onclick="changeQuantity(${item.id}, 1)" class="w-7 h-7 bg-red-600 text-white font-bold rounded flex items-center justify-center hover:bg-red-700">+</button>
                    </div>
                `;
                cartContainer.appendChild(itemEl);
            });

            subTotalEl.innerText = formatRupiah(subtotal);
            totalEl.innerText = formatRupiah(subtotal);
        }

        let selectedPaymentMethod = 'CASH'; // Default pembayaran

    // Fungsi untuk mengubah warna tombol CASH/QRIS saat diklik
    function selectPayment(method) {
        selectedPaymentMethod = method;
        const btnCash = document.getElementById('btn-cash');
        const btnQris = document.getElementById('btn-qris');

        if (method === 'CASH') {
            btnCash.className = "w-1/2 bg-red-600 text-white font-bold py-2 rounded-xl border-2 border-red-600 transition shadow-sm";
            btnQris.className = "w-1/2 bg-white text-gray-700 font-bold py-2 rounded-xl border-2 border-gray-200 hover:border-red-600 hover:text-red-600 transition shadow-sm";
        } else {
            btnQris.className = "w-1/2 bg-red-600 text-white font-bold py-2 rounded-xl border-2 border-red-600 transition shadow-sm";
            btnCash.className = "w-1/2 bg-white text-gray-700 font-bold py-2 rounded-xl border-2 border-gray-200 hover:border-red-600 hover:text-red-600 transition shadow-sm";
        }
    }

    // Fungsi untuk simpan tiket ke open tiket
    function saveTicket() {
        if (cart.length === 0) {
            showCustomToast('Keranjang masih kosong! Silakan pilih menu terlebih dahulu.');
            return;
        }

        // Ambil nilai meja langsung dari dropdown panel kanan
        let tableElement = document.getElementById('table_number');
        let tableNumber = tableElement ? tableElement.value : '';

        // Validasi wajib memilih meja/tipe pesanan terlebih dahulu
        if (!tableNumber) {
            showCustomToast('Silakan pilih Tipe Pesanan/Meja terlebih dahulu di panel detail pesanan!');
            if (tableElement) tableElement.focus();
            return;
        }

        let noteInput = document.getElementById('order_note') ? document.getElementById('order_note').value : '';

        // Kirim data ke controller dengan penanda status 'saved'
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
                status: 'saved', // Penanda bahwa ini disimpan ke open ticket
                payment_method: null 
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // TAMPILKAN MODAL SUKSES KUSTOM DI TENGAH LAYAR
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

    // Fungsi untuk menutup modal sukses dan me-refresh halaman
    function closeSuccessModal() {
        document.getElementById('success-modal').classList.add('hidden');
        cart = [];
        if (typeof renderCart === 'function') renderCart();
        location.reload();
    }
        // Tambahkan parameter paymentMethod (default 'CASH')
    function processPayment() {
        if (cart.length === 0) {
            showCustomToast('Keranjang masih kosong! Silakan pilih menu terlebih dahulu.');
            return;
        }

        let noteElement = document.getElementById('order_note');
        let noteValue = noteElement ? noteElement.value : '';
        
        // Ambil nilai dari input Nomor Meja
        let tableElement = document.getElementById('table_number');
        let tableValue = tableElement ? tableElement.value : '';

        fetch("{{ route('kasir.checkout') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            // Tambahkan payment_method dan table_number agar dikirim ke Laravel
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
                if (tableElement) tableElement.value = ''; // Kosongkan input meja juga
                
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

            // ----------------------------------------------------
            // TANGKAP DAN VALIDASI PILIHAN MEJA DARI PANEL KANAN
            // ----------------------------------------------------
            let tableSelect = document.getElementById('table_number');
            let selectedTable = tableSelect.value; // Mengambil value yang dipilih (Takeaway / Meja 1, dll)

            if (!selectedTable) {
                // Hentikan proses jika kasir belum memilih meja/takeaway
                showCustomToast('Silakan pilih Tipe Pesanan/Meja terlebih dahulu di detail pesanan!');
                tableSelect.focus(); // Arahkan fokus kembali ke dropdown
                return; 
            }

            // Masukkan teks pilihan meja ke dalam kotak statis di modal
            document.getElementById('modal-table-display').innerText = selectedTable;
            // ----------------------------------------------------

            let modalList = document.getElementById('modal-cart-list');
            let modalTotal = document.getElementById('modal-total-price');
            let total = 0;
            
            // Kosongkan tabel modal sebelumnya
            modalList.innerHTML = ''; 

            // Loop data keranjang dan masukkan ke tabel modal
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

            // ----------------------------------------------------
            // TANGKAP DAN TAMPILKAN CATATAN PESANAN DI MODAL
            // ----------------------------------------------------
            let noteInput = document.getElementById('order_note').value;
            let noteSection = document.getElementById('modal-note-section');
            let noteDisplay = document.getElementById('modal-note-display');

            // Pastikan elemen noteSection dan noteDisplay ada di HTML
            if (noteSection && noteDisplay) {
                if (noteInput.trim() !== '') {
                    // Jika ada catatan, isi teksnya dan munculkan kotak kuning
                    noteDisplay.innerText = noteInput;
                    noteSection.classList.remove('hidden');
                } else {
                    // Jika kosong, sembunyikan kotak kuningnya
                    noteSection.classList.add('hidden');
                }
            }

            // Tampilkan total dan buka modal
            modalTotal.innerHTML = `Rp ${total.toLocaleString('id-ID')}`;
            document.getElementById('confirm-modal').classList.remove('hidden');
        }

    function closeConfirmModal() {
        document.getElementById('confirm-modal').classList.add('hidden');
    }

    // Fitur Pencarian Menu Real-Time
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

        // Sesuaikan warna aksen jika tipe sukses (hijau) atau peringatan/error (merah)
        if (type === 'success') {
            toast.classList.remove('border-[#D21F2B]');
            toast.classList.add('border-[#1E7E34]');
            iconWrapper.className = 'w-9 h-9 rounded-full bg-green-50 text-[#1E7E34] flex items-center justify-center shrink-0';
        } else {
            toast.classList.remove('border-[#1E7E34]');
            toast.classList.add('border-[#D21F2B]');
            iconWrapper.className = 'w-9 h-9 rounded-full bg-red-50 text-[#D21F2B] flex items-center justify-center shrink-0';
        }

        // Tampilkan dengan animasi turun halus
        toast.classList.remove('hidden');
        toast.classList.add('flex');
        requestAnimationFrame(() => {
            toast.classList.remove('opacity-0', '-translate-y-4');
            toast.classList.add('opacity-100', 'translate-y-0');
        });

        // Otomatis hilang setelah 3 detik
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
    </script>
</body>
</html>