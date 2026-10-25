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
        <!-- Logo -->
        <div class="w-64">
            <h1 class="text-2xl font-bold text-red-600 tracking-tight">kasir.in <span class="text-gray-400 text-sm font-normal">| Kuah Kuwi</span></h1>
        </div>

        <!-- Navigasi Tengah -->
        <div class="flex gap-10 items-center justify-center">
            <!-- Beranda (Active) -->
            <a href="#" class="flex items-center gap-2 text-red-500 font-bold">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                Beranda
            </a>
            <!-- Open Ticket -->
            <a href="#" class="flex items-center gap-2 text-gray-400 font-semibold hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Open Ticket
            </a>
            <!-- Riwayat -->
            <a href="#" class="flex items-center gap-2 text-gray-400 font-semibold hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Riwayat
            </a>
        </div>

        <!-- Info Kanan (Waktu & Profil) -->
        <div class="flex items-center gap-4 w-64 justify-end">
            <div id="realtime-clock" class="bg-gray-100 px-4 py-2 rounded-full text-sm font-semibold text-gray-700 tracking-wide">
                --:--:-- --/--/----
            </div>
            <!-- Foto Profil -->
            <div class="w-10 h-10 rounded-full bg-gray-300 overflow-hidden border border-gray-200">
                <img src="https://ui-avatars.com/api/?name=Kasir&background=random" alt="Profil Kasir" class="w-full h-full object-cover">
            </div>
        </div>
    </nav>

    <!-- Body Wrapper (Sidebar & Main Content) -->
    <div class="flex flex-1 overflow-hidden">
        
        <!-- Sidebar Kiri -->
        <aside class="w-24 bg-white border-r flex flex-col justify-between py-6 items-center shadow-sm z-0 shrink-0">
            <!-- Kategori Menu -->
            <div class="flex flex-col gap-4 w-full px-3">
                <!-- Noodle (Active) -->
                <div class="flex flex-col items-center justify-center py-4 bg-red-50 text-red-500 rounded-xl cursor-pointer border border-red-100 transition">
                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"></path></svg>
                    <span class="text-xs font-bold">Noodle</span>
                </div>
                <!-- Gyoza -->
                <div class="flex flex-col items-center justify-center py-4 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl cursor-pointer transition">
                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-xs font-semibold">Gyoza</span>
                </div>
                <!-- Drink -->
                <div class="flex flex-col items-center justify-center py-4 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl cursor-pointer transition">
                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 8h-3V4H3c-.6 0-1 .4-1 1v15c0 .6.4 1 1 1h15c.6 0 1-.4 1-1v-5h2V8zM10 12v3H6v-3h4z"></path></svg>
                    <span class="text-xs font-semibold">Drink</span>
                </div>
            </div>

            <!-- Tombol Aksi Bawah -->
            <div class="flex flex-col gap-3 w-full px-3">
                <button class="w-full bg-gray-400 text-white py-2 rounded-md text-xs font-bold flex flex-col items-center justify-center gap-1 hover:bg-gray-500 transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Setting
                </button>
                
                <!-- Form Logout menyatu dengan Tutup Kasir -->
                <form action="{{ route('logout') }}" method="POST" class="w-full m-0 p-0">
                    @csrf
                    <button type="submit" class="w-full bg-yellow-400 text-white py-3 rounded-md text-xs font-bold hover:bg-yellow-500 transition shadow-sm">
                        Tutup Kasir
                    </button>
                </form>
            </div>
        </aside>

        <!-- Area Konten Utama (Scrollable) -->
        <main class="flex-1 p-6 overflow-y-auto">
            
            <div class="flex gap-6 max-w-7xl mx-auto h-full">
                <!-- Area Kiri: Daftar Menu (Persis seperti sebelumnya) -->
                <div class="w-2/3">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-bold text-gray-800">Daftar Menu</h2>
                    </div>
                    
                    <!-- Grid Menu -->
                    <div class="grid grid-cols-3 gap-4">
                        @foreach ($products as $product)
                        <div class="bg-white p-6 rounded-xl shadow-sm border-2 border-gray-200 cursor-pointer hover:bg-red-50 hover:border-red-500 hover:text-red-600 transition flex flex-col items-center justify-center h-32 group">
                            <h3 class="font-bold text-lg text-gray-800 group-hover:text-red-600 text-center">{{ $product->name }}</h3>
                            <p class="text-sm font-semibold text-gray-400 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Area Kanan: Keranjang/Cart (Persis seperti sebelumnya) -->
                <div class="w-1/3 bg-white p-5 rounded-xl shadow-sm border border-gray-200 h-fit sticky top-0">
                    <h2 class="text-lg font-bold text-blue-800 border-b pb-3 mb-4">Detail pesanan</h2>
                    
                    <div class="text-gray-400 text-center py-10 text-sm italic">
                        Belum ada menu yang dipilih
                    </div>

                    <div class="border-t border-dashed pt-4 mt-4">
                        <div class="flex justify-between text-sm text-gray-500 mb-2">
                            <span>Sub Total</span>
                            <span class="font-bold text-gray-800">Rp 0</span>
                        </div>
                        <div class="flex justify-between font-bold text-lg text-gray-800 mb-6">
                            <span>Total</span>
                            <span>Rp 0</span>
                        </div>
                        
                        <div class="flex gap-3">
                            <button class="w-1/2 bg-gray-400 text-white font-bold py-3 rounded-lg hover:bg-gray-500 transition shadow-sm">
                                Simpan
                            </button>
                            <button class="w-1/2 bg-red-600 text-white font-bold py-3 rounded-lg hover:bg-red-700 transition shadow-md">
                                Bayar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- Script untuk Jam Real-time -->
    <script>
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const date = now.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
            document.getElementById('realtime-clock').innerText = `${time}  ${date}`;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>