<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Ticket - POS Kuah Kuwi</title>
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
                Pesanan Tertunda
            </span>
            <div class="w-9 h-9 rounded-full bg-[#D21F2B] text-white font-extrabold text-xs flex items-center justify-center shadow-sm shrink-0">
                KA
            </div>
        </div>
    </nav>

    <!-- Body Wrapper -->
    <div class="flex flex-1 overflow-hidden">
        
        <!-- Area Utama Daftar Open Ticket -->
        <main class="flex-1 p-6 overflow-y-auto">
            <div class="mb-6">
                <h2 class="text-xl font-extrabold text-gray-900">Daftar Meja / Open Ticket Aktif</h2>
                <p class="text-xs text-gray-500 mt-0.5">Pilih kartu pesanan yang tersimpan untuk melanjutkan pembayaran</p>
            </div>

            @if($openTickets->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-200 text-center py-20 text-gray-400 italic text-sm">
                    Belum ada pesanan yang disimpan (Open Ticket kosong).
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($openTickets as $ticket)
                    <div id="ticket-card-{{ $ticket->id }}" onclick='selectTicket(@json($ticket))' 
                         class="ticket-card bg-white p-5 rounded-2xl shadow-sm border-2 border-[#D21F2B]/70 hover:border-[#D21F2B] cursor-pointer hover:shadow-md transition flex flex-col justify-between min-h-[168px] group">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-1">
                                <h3 class="font-extrabold text-base text-gray-900 group-hover:text-[#D21F2B] uppercase transition">{{ $ticket->table_number }}</h3>
                                <span class="text-[10px] font-extrabold uppercase tracking-wider px-2 py-0.5 rounded-full bg-red-50 text-[#D21F2B]">
                                    Open
                                </span>
                            </div>
                            <p class="text-xs font-medium text-gray-400">Nota: {{ $ticket->receipt_number }}</p>
                            @if($ticket->note)
                                <p class="text-[11px] text-amber-800 italic mt-2 bg-amber-50 border border-amber-200 px-2.5 py-1 rounded-lg line-clamp-2">
                                    Catatan: {{ $ticket->note }}
                                </p>
                            @endif
                        </div>
                        <div class="pt-3 mt-3 border-t border-dashed border-gray-100">
                            <p class="text-[11px] text-gray-400">{{ $ticket->created_at->format('d M Y, H:i') }}</p>
                            <p class="text-sm font-extrabold text-[#D21F2B] mt-0.5">Total : Rp {{ number_format($ticket->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </main>

        <!-- Panel Kanan: Detail Pesanan yang Dipilih -->
        <aside class="w-1/3 bg-white p-6 border-l border-gray-200 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-4">
                    <h2 id="detail-title" class="text-lg font-extrabold text-[#D21F2B]">Detail Pesanan</h2>
                    <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-red-50 text-[#D21F2B]">Kuah Kuwi</span>
                </div>
                
                <div id="detail-items" class="space-y-3 max-h-[380px] overflow-y-auto pr-1 mb-4">
                    <div class="text-gray-400 text-center py-16 text-sm italic">
                        Pilih kartu meja di sebelah kiri untuk melihat detail
                    </div>
                </div>
            </div>

            <!-- Total & Tombol Aksi Bayar / Selesai -->
            <div id="detail-footer" class="border-t border-dashed border-gray-200 pt-4 hidden">
                <div class="flex justify-between font-extrabold text-lg text-gray-900 mb-5">
                    <span>Total</span>
                    <span id="detail-total" class="text-[#D21F2B]">Rp 0</span>
                </div>
                <button onclick="payTicket()" class="w-full bg-[#D21F2B] hover:bg-[#b51924] text-white font-bold py-3 rounded-xl transition shadow-md text-sm">
                    Bayar / Selesaikan Pesanan
                </button>
            </div>
        </aside>

    </div>

    <!-- Modal Konfirmasi Pembayaran Open Ticket -->
    <div id="confirm-modal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-[2px] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl p-6 w-[450px] max-w-full transform transition-all relative">
            <!-- Tombol Close -->
            <button onclick="closeConfirmModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h3 class="text-lg font-extrabold text-gray-900 mb-4 border-b border-gray-100 pb-3">Konfirmasi Pesanan</h3>

            <!-- Tipe Pesanan / Meja (Tampil Statis) -->
            <div class="mb-4">
                <span class="block text-xs font-bold text-gray-600 mb-1">Tipe Pesanan / Meja</span>
                <div id="modal-table-display" class="bg-red-50/50 border border-red-200 text-[#D21F2B] font-bold px-3.5 py-2 text-sm rounded-xl w-full">
                    -
                </div>
            </div>

            <!-- Tabel Daftar Item -->
            <div class="max-h-40 overflow-y-auto mb-4 pr-1">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 text-xs text-gray-400 uppercase">
                            <th class="pb-2 font-medium">Menu</th>
                            <th class="pb-2 text-center font-medium">Qty</th>
                            <th class="pb-2 text-right font-medium">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="modal-cart-list" class="divide-y divide-gray-100"></tbody>
                </table>
            </div>

            <!-- Bagian Catatan (Opsional) -->
            <div id="modal-note-section" class="mb-4 bg-amber-50 border border-amber-200 rounded-xl p-3 hidden">
                <span class="block text-xs font-bold text-amber-800 mb-0.5">Catatan Pesanan:</span>
                <p id="modal-note-display" class="text-xs text-amber-700 italic font-medium"></p>
            </div>

            <!-- Total Keseluruhan -->
            <div class="flex justify-between items-center mb-5 pt-3 border-t border-gray-200">
                <span class="text-sm font-medium text-gray-500">Total Keseluruhan</span>
                <span id="modal-total-price" class="text-2xl font-extrabold text-gray-900">Rp 0</span>
            </div>

            <!-- Pilihan Metode Pembayaran -->
            <div class="mb-6">
                <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2 text-center">Metode Pembayaran</span>
                <div class="flex gap-3">
                    <button type="button" id="btn-cash" onclick="selectPayment('CASH')" class="w-1/2 bg-[#D21F2B] text-white font-bold py-2.5 rounded-xl border-2 border-[#D21F2B] transition shadow-sm text-sm">
                        CASH
                    </button>
                    <button type="button" id="btn-qris" onclick="selectPayment('QRIS')" class="w-1/2 bg-white text-gray-700 font-bold py-2.5 rounded-xl border-2 border-gray-200 hover:border-[#D21F2B] hover:text-[#D21F2B] transition shadow-sm text-sm">
                        QRIS
                    </button>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <button onclick="processPayment()" class="w-full bg-[#1E7E34] hover:bg-[#176428] text-white font-bold py-3 rounded-xl transition shadow-md text-sm">
                Konfirmasi & Bayar
            </button>
        </div>
    </div>

    <!-- Custom Toast Notification (Tengah Header) -->
    <div id="custom-toast"
        class="fixed top-4 left-1/2 -translate-x-1/2 z-[100] hidden items-center gap-3.5 bg-white border-l-4 border-[#D21F2B] shadow-2xl rounded-2xl px-5 py-3.5 min-w-[320px] max-w-md transition-all duration-300 opacity-0 -translate-y-4">
        <div class="w-9 h-9 rounded-full bg-red-50 text-[#D21F2B] flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
            </svg>
        </div>
        <div class="flex-1">
            <p id="toast-title" class="text-xs font-extrabold text-gray-900">Perhatian</p>
            <p id="toast-message" class="text-[11px] font-medium text-gray-600 mt-0.5 leading-snug">
                Silakan pilih tiket terlebih dahulu!
            </p>
        </div>
        <button type="button" onclick="hideCustomToast()" class="text-gray-400 hover:text-gray-700 text-lg font-bold leading-none px-1">
            &times;
        </button>
    </div>

    <!-- Script JavaScript Halaman Open Ticket -->
    <script>
        let selectedTicket = null;
        let selectedPaymentMethod = 'CASH';
        let toastTimeout;

        function showCustomToast(message, title = 'Perhatian') {
            const toast = document.getElementById('custom-toast');
            document.getElementById('toast-title').textContent = title;
            document.getElementById('toast-message').textContent = message;

            toast.classList.remove('hidden');
            toast.classList.add('flex');
            requestAnimationFrame(() => {
                toast.classList.remove('opacity-0', '-translate-y-4');
                toast.classList.add('opacity-100', 'translate-y-0');
            });

            clearTimeout(toastTimeout);
            toastTimeout = setTimeout(() => hideCustomToast(), 3000);
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

        // Pilih metode pembayaran di dalam modal
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

        // Saat tiket diklik dari daftar sebelah kiri
        function selectTicket(ticket) {
            selectedTicket = ticket;

            // Highlight kartu yang sedang dipilih
            document.querySelectorAll('.ticket-card').forEach(card => {
                card.classList.remove('ring-2', 'ring-[#D21F2B]', 'bg-red-50/30');
                card.classList.add('bg-white');
            });
            const activeCard = document.getElementById(`ticket-card-${ticket.id}`);
            if (activeCard) {
                activeCard.classList.remove('bg-white');
                activeCard.classList.add('ring-2', 'ring-[#D21F2B]', 'bg-red-50/30');
            }

            document.getElementById('detail-title').innerText = `Detail Pesanan (${ticket.table_number})`;
            
            let container = document.getElementById('detail-items');
            container.innerHTML = '';

            ticket.details.forEach(detail => {
                const productName = detail.product ? detail.product.name : 'Menu';
                container.innerHTML += `
                    <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div>
                            <h4 class="font-bold text-sm text-gray-800">${productName}</h4>
                            <p class="text-xs text-gray-400">Rp ${Number(detail.price).toLocaleString('id-ID')} <span class="text-[#D21F2B] font-bold">x ${detail.quantity}</span></p>
                        </div>
                        <span class="font-bold text-sm text-gray-800">Rp ${Number(detail.subtotal).toLocaleString('id-ID')}</span>
                    </div>
                `;
            });

            document.getElementById('detail-total').innerText = `Rp ${Number(ticket.total_amount).toLocaleString('id-ID')}`;
            document.getElementById('detail-footer').classList.remove('hidden');
        }

        // Saat tombol "Bayar / Selesaikan Pesanan" diklik -> Buka Modal Konfirmasi
        function payTicket() {
            if (!selectedTicket) {
                showCustomToast('Silakan pilih tiket terlebih dahulu dari daftar di sebelah kiri!');
                return;
            }

            document.getElementById('modal-table-display').innerText = selectedTicket.table_number;

            let modalList = document.getElementById('modal-cart-list');
            modalList.innerHTML = '';
            
            selectedTicket.details.forEach(detail => {
                const productName = detail.product ? detail.product.name : 'Menu';
                modalList.innerHTML += `
                    <tr>
                        <td class="py-3 font-medium text-gray-800">${productName}</td>
                        <td class="py-3 text-center text-gray-600">${detail.quantity}</td>
                        <td class="py-3 text-right font-medium text-gray-800">Rp ${Number(detail.subtotal).toLocaleString('id-ID')}</td>
                    </tr>
                `;
            });

            let noteSection = document.getElementById('modal-note-section');
            let noteDisplay = document.getElementById('modal-note-display');
            if (selectedTicket.note && selectedTicket.note.trim() !== '') {
                noteDisplay.innerText = selectedTicket.note;
                noteSection.classList.remove('hidden');
            } else {
                noteSection.classList.add('hidden');
            }

            document.getElementById('modal-total-price').innerText = `Rp ${Number(selectedTicket.total_amount).toLocaleString('id-ID')}`;

            document.getElementById('confirm-modal').classList.remove('hidden');
            document.getElementById('confirm-modal').classList.add('flex');
        }

        function closeConfirmModal() {
            document.getElementById('confirm-modal').classList.add('hidden');
            document.getElementById('confirm-modal').classList.remove('flex');
        }

        // Proses akhir pembayaran setelah klik "Konfirmasi & Bayar" di modal
        function processPayment() {
            if (!selectedTicket) return;

            fetch(`/kasir/openticket/complete/${selectedTicket.id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    payment_method: selectedPaymentMethod
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeConfirmModal();
                    
                    if (selectedTicket.id) {
                        window.open('/kasir/struk/' + selectedTicket.id, '_blank');
                    }

                    setTimeout(() => {
                        location.reload();
                    }, 500);
                } else {
                    showCustomToast('Gagal: ' + data.message, 'Error');
                }
            })
            .catch(err => {
                console.error(err);
                showCustomToast('Terjadi kesalahan koneksi.', 'Error');
            });
        }
    </script>
</body>
</html>