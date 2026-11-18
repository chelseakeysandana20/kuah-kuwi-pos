<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - kasir.in | Kuah Kuwi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen flex flex-col text-gray-800">

    <!-- Top Navbar -->
    <header class="bg-white border-b border-gray-200 h-16 px-6 flex items-center justify-between sticky top-0 z-30">
        <div class="flex items-center gap-10">
            <span class="text-2xl font-extrabold text-[#D21F2B] tracking-tight">kasir.in</span>
            <h1 class="text-base font-bold text-gray-900">Dashboard</h1>
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2 px-4 py-1.5 rounded-full border border-gray-300 text-xs font-semibold text-gray-700 bg-white">
                <svg class="w-4 h-4 text-[#D21F2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Kuah Kuwi</span>
            </div>

            <div class="w-9 h-9 rounded-full bg-[#D21F2B] text-white flex items-center justify-center font-bold text-xs shadow-sm">
                OW
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="flex flex-1">
        <!-- Sidebar Kiri (Marun Gelap) -->
        <aside class="w-60 bg-[#590D12] text-white flex flex-col justify-between py-6 px-4 shrink-0">
            <nav class="space-y-2">
                <a href="{{ route('owner.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-full bg-[#D21F2B] text-white font-semibold text-sm shadow-md transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="javascript:void(0)" onclick="openOwnerSettingModal()"
                   class="flex items-center gap-3 px-4 py-3 rounded-full text-gray-300 hover:text-white hover:bg-white/10 font-medium text-sm transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
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

        <!-- Konten Utama -->
        <main class="flex-1 p-8 overflow-y-auto">
            @if (session('success'))
                <div id="owner-alert" class="mb-5 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-700 text-xs font-semibold flex items-center justify-between transition-opacity duration-500">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-green-900 font-bold">&times;</button>
                </div>
                
                <script>
                    setTimeout(function () {
                        const alertBox = document.getElementById('owner-alert');
                        if (alertBox) {
                            alertBox.style.opacity = '0';
                            setTimeout(() => alertBox.remove(), 500);
                        }
                    }, 3000);
                </script>
            @endif

            <!-- Header Overview & Filter -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Dashboard Overview</h2>
                    <p class="text-xs text-gray-400 mt-1 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Diperbarui {{ now()->format('H:i') }} WIB
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <!-- Tab Periode -->
                    <div class="bg-gray-200/80 p-1 rounded-xl flex items-center text-xs font-semibold">
                        <a href="{{ route('owner.dashboard', ['period' => 'hari_ini']) }}"
                           class="px-4 py-1.5 rounded-lg transition {{ $period === 'hari_ini' ? 'bg-white text-[#D21F2B] shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                            Hari Ini
                        </a>
                        <a href="{{ route('owner.dashboard', ['period' => 'minggu_ini']) }}"
                           class="px-4 py-1.5 rounded-lg transition {{ $period === 'minggu_ini' ? 'bg-white text-[#D21F2B] shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                            Minggu Ini
                        </a>
                        <a href="{{ route('owner.dashboard', ['period' => 'bulan_ini']) }}"
                           class="px-4 py-1.5 rounded-lg transition {{ $period === 'bulan_ini' ? 'bg-white text-[#D21F2B] shadow-sm' : 'text-gray-600 hover:text-gray-900' }}">
                            Bulan Ini
                        </a>
                    </div>

                    <!-- Tombol Ekspor Laporan -->
                    <a href="{{ route('owner.export', ['period' => $period]) }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-xs font-semibold text-gray-700 shadow-sm transition">
                        <svg class="w-4 h-4 text-[#D21F2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span>Ekspor Laporan</span>
                    </a>
                </div>
            </div>

            <!-- 4 Kartu KPI -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-7">
                <!-- Total Pesanan -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Total Pesanan</p>
                            <h3 class="text-2xl font-extrabold text-gray-900 mt-1">{{ number_format($totalPesanan, 0, ',', '.') }}</h3>
                        </div>
                        <div class="w-9 h-9 rounded-xl bg-red-50 text-[#D21F2B] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold {{ $pesananGrowth >= 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                            {{ $pesananGrowth >= 0 ? '↗ +' : '↘ ' }}{{ $pesananGrowth }}%
                        </span>
                    </div>
                </div>

                <!-- Total Nota -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Total Nota</p>
                            <h3 class="text-2xl font-extrabold text-gray-900 mt-1">{{ number_format($totalNota, 0, ',', '.') }}</h3>
                        </div>
                        <div class="w-9 h-9 rounded-xl bg-red-50 text-[#D21F2B] flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold {{ $notaGrowth >= 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                            {{ $notaGrowth >= 0 ? '↗ +' : '↘ ' }}{{ $notaGrowth }}%
                        </span>
                    </div>
                </div>

                <!-- Pendapatan Kotor -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Pendapatan Kotor</p>
                            <h3 class="text-2xl font-extrabold text-gray-900 mt-1">Rp{{ number_format($pendapatanKotor, 0, ',', '.') }}</h3>
                        </div>
                        <div class="w-9 h-9 rounded-xl bg-red-50 text-[#D21F2B] flex items-center justify-center font-bold text-xs">
                            Rp
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold {{ $pendapatanGrowth >= 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                            {{ $pendapatanGrowth >= 0 ? '↗ +' : '↘ ' }}{{ $pendapatanGrowth }}%
                        </span>
                    </div>
                </div>

                <!-- Best Seller -->
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400">Best Seller</p>
                        <h3 class="text-sm font-bold text-gray-900 mt-2 line-clamp-1">
                            {{ $bestSeller ? $bestSeller->name : 'Belum ada data' }}
                        </h3>
                    </div>
                    <p class="text-lg font-extrabold text-[#D21F2B] mt-2">
                        {{ $bestSeller ? $bestSeller->total_qty . ' pesanan' : '0 pesanan' }}
                    </p>
                </div>
            </div>

            <!-- Baris Bawah: Grafik & Top Selling Items -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Grafik Arus Penjualan & Pendapatan Per Jam -->
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <div class="flex flex-wrap items-start justify-between gap-4 mb-6">
                        <h3 class="text-base font-bold text-gray-900">Arus Penjualan & Pendapatan Per Jam</h3>

                        <div class="flex items-center gap-5 text-xs">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#D21F2B]"></span>
                                <div>
                                    <p class="font-semibold text-gray-700">Makan di Tempat</p>
                                    <p class="text-gray-400">(Rp{{ number_format($totalDineIn, 0, ',', '.') }})</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#590D12]"></span>
                                <div>
                                    <p class="font-semibold text-gray-700">Bawa Pulang</p>
                                    <p class="text-gray-400">(Rp{{ number_format($totalTakeAway, 0, ',', '.') }})</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="h-72">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Top Selling Items -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-base font-bold text-gray-900">Top selling items</h3>
                        <span class="text-xs font-semibold text-[#D21F2B]">Top {{ $topItems->count() }}</span>
                    </div>

                    <div class="space-y-4 flex-1">
                        @forelse($topItems as $index => $item)
                            <div class="flex items-center justify-between gap-3 pb-3 border-b border-gray-100 last:border-b-0">
                                <div class="flex items-center gap-3">
                                    <div class="w-11 h-11 rounded-xl bg-red-50 text-[#D21F2B] font-extrabold text-sm flex items-center justify-center shrink-0">
                                        #{{ $index + 1 }}
                                    </div>
                                    <p class="text-xs font-bold text-gray-800 leading-snug">
                                        {{ $item->name }}
                                    </p>
                                </div>
                                <div class="text-right shrink-0">
                                    <span class="text-xs font-extrabold text-gray-900">{{ $item->total_qty }}</span>
                                    <p class="text-[10px] text-gray-400">pesanan</p>
                                </div>
                            </div>
                        @empty
                            <div class="h-full flex items-center justify-center text-xs text-gray-400 italic py-10">
                                Belum ada transaksi pada periode ini.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Pengaturan Toko & Owner (kasir.in Theme) -->
    <div id="owner-setting-modal" class="hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-[2px] items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-6 relative">
            <!-- Header Modal -->
            <div class="flex items-center justify-between border-b border-gray-100 pb-3.5 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-red-50 text-[#D21F2B] flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-gray-900">Pengaturan Toko & Owner</h3>
                        <p class="text-[11px] text-gray-500">Konfigurasi profil outlet & laporan eksekutif</p>
                    </div>
                </div>
                <button type="button" onclick="closeOwnerSettingModal()" class="text-gray-400 hover:text-gray-700 text-xl font-bold leading-none">&times;</button>
            </div>

            <!-- Info Akun & Outlet -->
            <div class="bg-gray-50 rounded-xl p-3.5 mb-4 border border-gray-100 text-xs space-y-1.5">
                <div class="flex justify-between">
                    <span class="text-gray-500">Pemilik / Owner</span>
                    <span class="font-bold text-gray-900">{{ Auth::user()->name ?? 'Owner Kuah Kuwi' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Nama Outlet</span>
                    <span id="owner-outlet-label" class="font-bold text-[#D21F2B]">Kuah Kuwi • kasir.in</span>
                </div>
            </div>

            <!-- Opsi Pengaturan Owner -->
            <div class="space-y-3 mb-6">
                <div class="p-3 rounded-xl border border-gray-200">
                    <label class="block text-xs font-bold text-gray-800 mb-1">Nama Outlet / Cabang</label>
                    <input type="text" id="owner-store-name" value="Kuah Kuwi"
                        class="w-full text-xs font-semibold text-gray-800 border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:border-[#D21F2B]">
                </div>

                <label class="flex items-center justify-between p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition">
                    <div>
                        <p class="text-xs font-bold text-gray-800">Target Omzet Harian</p>
                        <p class="text-[11px] text-gray-500">Acuan evaluasi performa penjualan</p>
                    </div>
                    <div class="flex items-center gap-1">
                        <span class="text-xs font-bold text-gray-500">Rp</span>
                        <input type="number" id="owner-daily-target" step="50000" min="0" value="1500000"
                            class="w-28 text-right text-xs font-bold text-gray-800 border border-gray-300 rounded-lg px-2.5 py-1.5 focus:outline-none focus:border-[#D21F2B]">
                    </div>
                </label>

                <label class="flex items-center justify-between p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition">
                    <div>
                        <p class="text-xs font-bold text-gray-800">Periode Laporan Default</p>
                        <p class="text-[11px] text-gray-500">Tampilan awal saat membuka Dashboard</p>
                    </div>
                    <select id="owner-default-period" class="text-xs font-bold text-gray-800 border border-gray-300 rounded-lg px-2.5 py-1.5 focus:outline-none focus:border-[#D21F2B]">
                        <option value="today">Hari Ini</option>
                        <option value="week">Minggu Ini</option>
                        <option value="month">Bulan Ini</option>
                    </select>
                </label>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end gap-2.5">
                <button type="button" onclick="closeOwnerSettingModal()" class="px-4 py-2 rounded-xl border border-gray-300 text-xs font-bold text-gray-700 hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="button" onclick="saveOwnerSettings()" class="px-5 py-2 rounded-xl bg-[#D21F2B] hover:bg-[#b51924] text-white text-xs font-bold transition shadow-sm">
                    Simpan Pengaturan
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notifikasi Owner -->
    <div id="owner-toast" class="hidden fixed top-5 right-5 z-[60] bg-white border-l-4 border-emerald-500 shadow-xl rounded-xl px-4 py-3 flex items-center gap-3">
        <div class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xs">✓</div>
        <div>
            <p class="text-xs font-extrabold text-gray-900">Berhasil</p>
            <p class="text-[11px] text-gray-600">Pengaturan toko & owner berhasil disimpan!</p>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');

        const redGradient = ctx.createLinearGradient(0, 0, 0, 280);
        redGradient.addColorStop(0, 'rgba(210, 31, 43, 0.25)');
        redGradient.addColorStop(1, 'rgba(210, 31, 43, 0.0)');

        const darkGradient = ctx.createLinearGradient(0, 0, 0, 280);
        darkGradient.addColorStop(0, 'rgba(89, 13, 18, 0.22)');
        darkGradient.addColorStop(1, 'rgba(89, 13, 18, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($hourLabels),
                datasets: [
                    {
                        label: 'Makan di Tempat',
                        data: @json($dineInData),
                        borderColor: '#D21F2B',
                        backgroundColor: redGradient,
                        borderWidth: 2.5,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Bawa Pulang',
                        data: @json($takeAwayData),
                        borderColor: '#590D12',
                        backgroundColor: darkGradient,
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1F2937',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 10 }, color: '#6B7280' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: '#F3F4F6' },
                        ticks: {
                            font: { size: 10 },
                            color: '#9CA3AF',
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

    function openOwnerSettingModal() {
        const modal = document.getElementById('owner-setting-modal');
        if (!modal) return;

        document.getElementById('owner-store-name').value = localStorage.getItem('owner_store_name') || 'Kuah Kuwi';
        document.getElementById('owner-daily-target').value = localStorage.getItem('owner_daily_target') || '1500000';
        document.getElementById('owner-default-period').value = localStorage.getItem('owner_default_period') || 'today';

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeOwnerSettingModal() {
        const modal = document.getElementById('owner-setting-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function saveOwnerSettings() {
        const storeName = document.getElementById('owner-store-name').value.trim() || 'Kuah Kuwi';
        const dailyTarget = document.getElementById('owner-daily-target').value || '1500000';
        const defaultPeriod = document.getElementById('owner-default-period').value;

        localStorage.setItem('owner_store_name', storeName);
        localStorage.setItem('owner_daily_target', dailyTarget);
        localStorage.setItem('owner_default_period', defaultPeriod);

        document.getElementById('owner-outlet-label').innerText = `${storeName} • kasir.in`;

        closeOwnerSettingModal();

        const toast = document.getElementById('owner-toast');
        if (toast) {
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }
    } 
        
    </script>
</body>
</html>