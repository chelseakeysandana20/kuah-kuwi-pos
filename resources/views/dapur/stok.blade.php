<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Dashboard - kasir.in | Kuah Kuwi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#F8F9FA] min-h-screen flex flex-col text-gray-800">

    <!-- Top Navbar -->
    <header class="bg-white border-b border-gray-200 h-16 px-6 flex items-center justify-between sticky top-0 z-30">
        <div class="flex items-center gap-10">
            <span class="text-2xl font-extrabold text-[#D21F2B] tracking-tight">kasir.in</span>
            <h1 class="text-base font-bold text-gray-900">Stock - Dashboard</h1>
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
    <div class="flex flex-1">
        <!-- Sidebar Kiri (Marun Gelap serasi dengan Owner) -->
        <aside class="w-60 bg-[#590D12] text-white flex flex-col justify-between py-6 px-4 shrink-0">
            <nav class="space-y-2">
                <a href="{{ route('dapur.stok') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-full bg-[#D21F2B] text-white font-semibold text-sm shadow-md transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="#" onclick="alert('Pengaturan batas minimum stok tersedia pada setiap item.')"
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
                <div class="mb-5 px-4 py-3 rounded-xl bg-green-50 border border-green-200 text-green-700 text-xs font-semibold flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="text-green-900 font-bold">&times;</button>
                </div>
            @endif

            <!-- Header & Ekspor Data -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Manajemen Stok</h2>

                <a href="{{ route('dapur.stok.export') }}"
                   class="flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-300 bg-white hover:bg-gray-50 text-xs font-semibold text-gray-700 shadow-sm transition">
                    <svg class="w-4 h-4 text-[#D21F2B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span>Ekspor Data</span>
                </a>
            </div>

            <!-- 4 Kartu Status Stok -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-blue-700">Total Jenis Bahan</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-extrabold text-gray-900">{{ $totalJenis }}</span>
                        <span class="text-xs font-medium text-gray-400">Item</span>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-green-600">Stok Aman</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-extrabold text-gray-900">{{ $stokAman }}</span>
                        <span class="text-xs font-medium text-gray-400">Item</span>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-amber-500">Perlu Belanja</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-extrabold text-gray-900">{{ $perluBelanja }}</span>
                        <span class="text-xs font-medium text-gray-400">Item</span>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-[#D21F2B]">Habis</p>
                    <div class="flex items-baseline gap-2 mt-2">
                        <span class="text-3xl font-extrabold text-gray-900">{{ $stokHabis }}</span>
                        <span class="text-xs font-medium text-gray-400">Item</span>
                    </div>
                </div>
            </div>

            <!-- Toolbar Pencarian, Filter & Tambah Stok -->
            <form method="GET" action="{{ route('dapur.stok') }}"
                  class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-6 flex flex-wrap items-center justify-between gap-3">
                
                <!-- Input Cari -->
                <div class="relative flex-1 min-w-[220px]">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama bahan, kode SKU"
                           class="w-full pl-10 pr-4 py-2 rounded-xl bg-gray-100 border-transparent focus:bg-white focus:border-[#D21F2B] focus:outline-none text-xs transition">
                </div>

                <!-- Dropdown Kategori -->
                <select name="category" onchange="this.form.submit()"
                        class="px-4 py-2 rounded-xl bg-gray-100 text-xs font-semibold text-gray-700 focus:outline-none cursor-pointer">
                    <option value="all">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                <!-- Dropdown Status -->
                <select name="status" onchange="this.form.submit()"
                        class="px-4 py-2 rounded-xl bg-gray-100 text-xs font-semibold text-gray-700 focus:outline-none cursor-pointer">
                    <option value="all">Semua Status</option>
                    <option value="aman" {{ request('status') === 'aman' ? 'selected' : '' }}>Aman</option>
                    <option value="perlu_belanja" {{ request('status') === 'perlu_belanja' ? 'selected' : '' }}>Perlu Belanja</option>
                    <option value="habis" {{ request('status') === 'habis' ? 'selected' : '' }}>Habis</option>
                </select>

                <!-- Tombol Tambah Stok (Modal) -->
                <button type="button" onclick="openAddModal()"
                        class="flex items-center gap-2 px-5 py-2 rounded-xl bg-[#1E7E34] hover:bg-[#166327] text-white text-xs font-semibold shadow-sm transition">
                    <span class="text-base leading-none">+</span>
                    <span>Tambah Stok</span>
                </button>
            </form>

            <!-- Tabel Daftar Stok Bahan -->
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-200/80 text-[11px] font-bold uppercase tracking-wider text-gray-600 border-b border-gray-200">
                                <th class="py-3.5 px-4 text-center w-14">NO</th>
                                <th class="py-3.5 px-5">NAMA PRODUK / BAHAN</th>
                                <th class="py-3.5 px-5">KETERANGAN</th>
                                <th class="py-3.5 px-5 text-center">STOK SAAT INI</th>
                                <th class="py-3.5 px-5 text-center">SATUAN</th>
                                <th class="py-3.5 px-5 text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-xs font-medium text-gray-800">
                            @forelse ($ingredients as $index => $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-3.5 px-4 text-center bg-gray-100/70 font-semibold text-gray-500">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="py-3.5 px-5">
                                        <div class="font-bold text-gray-900">{{ $item->name }}</div>
                                        @if ($item->sku)
                                            <div class="text-[10px] text-gray-400">{{ $item->sku }}</div>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-5 text-gray-600">
                                        {{ $item->category }}
                                    </td>
                                    <td class="py-3.5 px-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Tombol Kurang Stok -->
                                            <form action="{{ route('dapur.stok.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="action" value="decrement">
                                                <button type="submit" {{ $item->stock <= 0 ? 'disabled' : '' }}
                                                        class="w-6 h-6 rounded-md bg-gray-100 hover:bg-red-100 hover:text-[#D21F2B] disabled:opacity-40 font-bold flex items-center justify-center transition">
                                                    -
                                                </button>
                                            </form>

                                            <span class="w-12 text-center font-bold {{ $item->stock <= 0 ? 'text-[#D21F2B]' : 'text-gray-900' }}">
                                                {{ $item->stock <= 0 ? 'Habis' : $item->stock }}
                                            </span>

                                            <!-- Tombol Tambah Stok -->
                                            <form action="{{ route('dapur.stok.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="action" value="increment">
                                                <button type="submit"
                                                        class="w-6 h-6 rounded-md bg-gray-100 hover:bg-green-100 hover:text-green-700 font-bold flex items-center justify-center transition">
                                                    +
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-5 text-center text-gray-600">
                                        {{ $item->unit }}
                                    </td>
                                    <td class="py-3.5 px-5 text-center">
                                        @if ($item->status === 'habis')
                                            <span class="inline-block px-4 py-1 rounded-md bg-[#D21F2B] text-white text-[11px] font-semibold">
                                                habis
                                            </span>
                                        @elseif ($item->status === 'perlu_belanja')
                                            <span class="inline-block px-3 py-1 rounded-md bg-amber-500 text-white text-[11px] font-semibold">
                                                perlu belanja
                                            </span>
                                        @else
                                            <span class="inline-block px-4 py-1 rounded-md bg-[#1E7E34] text-white text-[11px] font-semibold">
                                                aman
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 text-center text-gray-400 italic">
                                        Data bahan baku tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah Bahan Baku Baru -->
    <div id="add-stock-modal" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-base font-bold text-gray-900">Tambah Bahan Baku Baru</h3>
                <button type="button" onclick="closeAddModal()" class="text-gray-400 hover:text-gray-700 text-xl font-bold">&times;</button>
            </div>

            <form action="{{ route('dapur.stok.store') }}" method="POST" class="space-y-4 text-xs">
                @csrf
                <div>
                    <label class="block font-semibold text-gray-600 mb-1">Nama Produk / Bahan</label>
                    <input type="text" name="name" required placeholder="Contoh: Kulit Gyoza"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:border-[#D21F2B] focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">Keterangan / Kategori</label>
                        <select name="category" class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:border-[#D21F2B] focus:outline-none">
                            <option value="Dapur Dalam">Dapur Dalam</option>
                            <option value="Bumbu & Sayur">Bumbu & Sayur</option>
                            <option value="Frozen & Olahan">Frozen & Olahan</option>
                            <option value="Minuman & Kemasan">Minuman & Kemasan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">Satuan</label>
                        <input type="text" name="unit" required value="Bungkus" placeholder="Bungkus / Buah / Kg"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:border-[#D21F2B] focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">Stok Saat Ini</label>
                        <input type="number" name="stock" required min="0" value="10"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:border-[#D21F2B] focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-semibold text-gray-600 mb-1">Batas Minimum Belanja</label>
                        <input type="number" name="min_stock" required min="0" value="5"
                               class="w-full px-3.5 py-2.5 rounded-xl border border-gray-300 focus:border-[#D21F2B] focus:outline-none">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3">
                    <button type="button" onclick="closeAddModal()"
                            class="px-4 py-2 rounded-xl border border-gray-300 text-gray-600 font-semibold hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-5 py-2 rounded-xl bg-[#D21F2B] hover:bg-[#b51924] text-white font-semibold shadow-sm">
                        Simpan Bahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('add-stock-modal').classList.remove('hidden');
        }
        function closeAddModal() {
            document.getElementById('add-stock-modal').classList.add('hidden');
        }
    </script>
</body>
</html>