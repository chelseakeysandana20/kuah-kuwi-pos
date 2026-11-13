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
                <div class="flex flex-col items-center justify-center py-4 bg-red-50 text-red-500 rounded-xl cursor-pointer border border-red-100 transition">
                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"></path></svg>
                    <span class="text-xs font-bold">Noodle</span>
                </div>
                <div class="flex flex-col items-center justify-center py-4 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl cursor-pointer transition">
                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-xs font-semibold">Gyoza</span>
                </div>
                <div class="flex flex-col items-center justify-center py-4 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl cursor-pointer transition">
                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 8h-3V4H3c-.6 0-1 .4-1 1v15c0 .6.4 1 1 1h15c.6 0 1-.4 1-1v-5h2V8zM10 12v3H6v-3h4z"></path></svg>
                    <span class="text-xs font-semibold">Drink</span>
                </div>
            </div>

            <div class="flex flex-col gap-3 w-full px-3">
                <button class="w-full bg-gray-400 text-white py-2 rounded-md text-xs font-bold flex flex-col items-center justify-center gap-1 hover:bg-gray-500 transition shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Setting
                </button>
                
                <form action="{{ route('logout') }}" method="POST" class="w-full m-0 p-0">
                    @csrf
                    <button type="submit" class="w-full bg-yellow-400 text-white py-3 rounded-md text-xs font-bold hover:bg-yellow-500 transition shadow-sm">
                        Tutup Kasir
                    </button>
                </form>
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
                             class="bg-white p-6 rounded-xl shadow-sm border-2 border-gray-200 cursor-pointer hover:bg-red-50 hover:border-red-500 hover:text-red-600 transition flex flex-col items-center justify-center h-32 group">
                            <h3 class="font-bold text-lg text-gray-800 group-hover:text-red-600 text-center">{{ $product->name }}</h3>
                            <p class="text-sm font-semibold text-gray-400 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        @endforeach
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
            alert('Keranjang masih kosong! Silakan pilih menu terlebih dahulu.');
            return;
        }

        let noteInput = document.getElementById('order_note') ? document.getElementById('order_note').value : '';
        // Gunakan fungsi prompt/alert sementara untuk meminta nomor meja jika belum dipilih
        let tableNumber = prompt("Masukkan Tipe Pesanan / Nomor Meja (Contoh: Takeaway / Meja 1):", "Takeaway");
        
        if (!tableNumber) {
            alert('Penyimpanan dibatalkan karena nomor meja kosong.');
            return;
        }

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
                status: 'saved', // Penanda bahwa ini hanya di-simpan, bukan dibayar
                payment_method: null // Belum ada metode pembayaran
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Pesanan berhasil disimpan ke Open Ticket!');
                
                // Reset form dan keranjang
                cart = [];
                if (typeof renderCart === 'function') renderCart();
                if (document.getElementById('order_note')) document.getElementById('order_note').value = ''; 
            } else {
                alert('Gagal menyimpan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error detail:', error);
            alert('Terjadi kesalahan sistem.');
        });
    }

        // Tambahkan parameter paymentMethod (default 'CASH')
    function processPayment() {
        if (cart.length === 0) {
            alert('Keranjang masih kosong! Silakan pilih menu terlebih dahulu.');
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
                alert('Gagal: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error detail:', error);
            alert('Terjadi kesalahan JavaScript: ' + error.message);
        });
    }

    function showConfirmModal() {
            if (cart.length === 0) {
                alert('Keranjang masih kosong! Silakan pilih menu terlebih dahulu.');
                return;
            }

            // ----------------------------------------------------
            // TANGKAP DAN VALIDASI PILIHAN MEJA DARI PANEL KANAN
            // ----------------------------------------------------
            let tableSelect = document.getElementById('table_number');
            let selectedTable = tableSelect.value; // Mengambil value yang dipilih (Takeaway / Meja 1, dll)

            if (!selectedTable) {
                // Hentikan proses jika kasir belum memilih meja/takeaway
                alert('Silakan pilih Tipe Pesanan/Meja terlebih dahulu di detail pesanan!');
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
    </script>
</body>
</html>