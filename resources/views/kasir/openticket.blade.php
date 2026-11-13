<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Ticket - POS Kuah Kuwi</title>
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
        
        <!-- Area Utama Daftar Open Ticket -->
        <main class="flex-1 p-6 overflow-y-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Daftar Meja / Open Ticket Aktif</h2>

            @if($openTickets->isEmpty())
                <div class="text-center py-20 text-gray-400 italic">
                    Belum ada pesanan yang disimpan (Open Ticket kosong).
                </div>
            @else
                <div class="grid grid-cols-4 gap-6">
                    @foreach($openTickets as $ticket)
                    <div onclick="selectTicket({{ json_encode($ticket) }})" 
                         class="bg-white p-6 rounded-2xl shadow-sm border-2 border-yellow-400 cursor-pointer hover:shadow-md transition flex flex-col justify-between h-40 group">
                        <div>
                            <h3 class="font-bold text-lg text-gray-800 uppercase">{{ $ticket->table_number }}</h3>
                            <p class="text-xs text-gray-400 mt-1">Nota: {{ $ticket->receipt_number }}</p>
                            @if($ticket->note)
                                <p class="text-xs text-yellow-600 italic mt-1 bg-yellow-50 p-1 rounded">Catatan: {{ $ticket->note }}</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">{{ $ticket->created_at->format('d M Y, H:i') }}</p>
                            <p class="text-sm font-bold text-gray-800 mt-1">Total : Rp {{ number_format($ticket->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </main>

        <!-- Panel Kanan: Detail Pesanan yang Dipilih -->
        <aside class="w-1/3 bg-white p-6 border-l shadow-sm flex flex-col justify-between">
            <div>
                <h2 id="detail-title" class="text-lg font-bold text-blue-800 border-b pb-3 mb-4">Detail Pesanan</h2>
                
                <div id="detail-items" class="space-y-3 max-h-[350px] overflow-y-auto pr-1 mb-4">
                    <div class="text-gray-400 text-center py-10 text-sm italic">
                        Pilih kartu meja di sebelah kiri untuk melihat detail
                    </div>
                </div>
            </div>

            <!-- Total & Tombol Aksi Bayar / Selesai -->
            <div id="detail-footer" class="border-t border-dashed pt-4 hidden">
                <div class="flex justify-between font-bold text-lg text-gray-800 mb-6">
                    <span>Total</span>
                    <span id="detail-total">Rp 0</span>
                </div>
                <button onclick="payTicket()" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl transition shadow-md">
                    Bayar / Selesaikan Pesanan
                </button>
            </div>
        </aside>

    </div>

    <script>
        let selectedTicket = null;

        function selectTicket(ticket) {
            selectedTicket = ticket;
            document.getElementById('detail-title').innerText = `Detail Pesanan (${ticket.table_number})`;
            
            let container = document.getElementById('detail-items');
            container.innerHTML = '';

            ticket.details.forEach(detail => {
                container.innerHTML += `
                    <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg border border-gray-100">
                        <div>
                            <h4 class="font-bold text-sm text-gray-800">${detail.product.name}</h4>
                            <p class="text-xs text-gray-400">Rp ${Number(detail.price).toLocaleString('id-ID')} x ${detail.quantity}</p>
                        </div>
                        <span class="font-bold text-sm text-gray-800">Rp ${Number(detail.subtotal).toLocaleString('id-ID')}</span>
                    </div>
                `;
            });

            document.getElementById('detail-total').innerText = `Rp ${Number(ticket.total_amount).toLocaleString('id-ID')}`;
            document.getElementById('detail-footer').classList.remove('hidden');
        }

        function payTicket() {
            if (!selectedTicket) return;

            if (confirm(`Selesaikan dan tandai lunas pesanan untuk ${selectedTicket.table_number}?`)) {
                fetch(`/kasir/openticket/complete/${selectedTicket.id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); // Muat ulang halaman untuk memperbarui daftar meja
                    } else {
                        alert('Gagal: ' + data.message);
                    }
                })
                .catch(err => console.error(err));
            }
        }
    </script>
</body>
</html>