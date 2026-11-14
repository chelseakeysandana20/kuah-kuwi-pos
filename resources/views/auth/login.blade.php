<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kasir.in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-[#D21F2B] h-screen w-screen flex items-center justify-center overflow-hidden relative select-none">

    <!-- Teks Brand Background (Z-Index 0) -->
    <h1 class="absolute z-0 text-[#FDF6EC] text-6xl md:text-8xl lg:text-[13rem] font-extrabold tracking-tight select-none pointer-events-none opacity-100">
        kasir.in
    </h1>

    <!-- Card Login (Z-Index 10) -->
    <div class="relative z-10 bg-white w-11/12 max-w-[420px] rounded-2xl shadow-xl px-8 py-10 transition-all duration-300">
        <h2 class="text-center text-xl font-bold text-gray-800 mb-8">Login form</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="username" id="selected-username" value="{{ old('username') }}" required>

            <!-- Menampilkan Error Pesan Login -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-600 text-xs rounded-xl text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Dropdown Pilih Akun -->
            <div class="mb-5 relative">
                <label class="block text-[11px] font-medium text-gray-500 mb-1.5 ml-1">Username</label>

                <button type="button" id="dropdown-trigger" onclick="toggleDropdown()"
                        class="w-full text-left px-5 py-2.5 rounded-full border border-[#E26D73] text-sm transition flex items-center justify-between bg-white focus:outline-none">
                    <span id="dropdown-label" class="{{ old('username') ? 'text-gray-800 font-semibold' : 'text-gray-400' }}">
                        @if(old('username') === 'owner') Owner
                        @elseif(old('username') === 'kasir') Cashier
                        @elseif(old('username') === 'dapur') Kitchen
                        @else chose account
                        @endif
                    </span>
                    <svg id="dropdown-arrow" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- List Pilihan Akun -->
                <div id="dropdown-menu" class="hidden absolute left-0 right-0 z-20 mt-2 bg-white border border-[#E26D73] rounded-xl overflow-hidden shadow-md">
                    <div onclick="chooseAccount('owner', 'Owner')" 
                         class="px-5 py-2.5 text-sm font-medium text-gray-800 hover:bg-red-50 hover:text-[#D21F2B] cursor-pointer border-b border-gray-100 transition">
                        Owner
                    </div>
                    <div onclick="chooseAccount('kasir', 'Cashier')" 
                         class="px-5 py-2.5 text-sm font-medium text-gray-800 hover:bg-red-50 hover:text-[#D21F2B] cursor-pointer border-b border-gray-100 transition">
                        Cashier
                    </div>
                    <div onclick="chooseAccount('dapur', 'Kitchen')" 
                         class="px-5 py-2.5 text-sm font-medium text-gray-800 hover:bg-red-50 hover:text-[#D21F2B] cursor-pointer transition">
                        Kitchen
                    </div>
                </div>
            </div>

            <!-- Input Password (Muncul setelah memilih akun) -->
            <div id="password-section" class="{{ old('username') ? '' : 'hidden' }} mb-7">
                <label for="password" class="block text-[11px] font-medium text-gray-500 mb-1.5 ml-1">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" required
                        class="w-full px-5 py-2.5 pr-11 rounded-full border border-[#E26D73] text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#D21F2B] transition"
                        placeholder="Enter password">
                    
                    <!-- Tombol Show/Hide Password -->
                    <button type="button" onclick="togglePasswordVisibility()" 
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Tombol Login (Pill Shape) -->
            <div>
                <button type="submit" id="btn-submit" {{ old('username') ? '' : 'disabled' }}
                    class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white {{ old('username') ? 'bg-[#D21F2B] hover:bg-[#b51924] cursor-pointer' : 'bg-[#5a5a5a] cursor-not-allowed' }} transition-colors">
                    Login
                </button>
            </div>
        </form>
    </div>

    <script>
        function toggleDropdown() {
            const menu = document.getElementById('dropdown-menu');
            const arrow = document.getElementById('dropdown-arrow');
            menu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }

        function chooseAccount(usernameValue, labelText) {
            document.getElementById('selected-username').value = usernameValue;

            const label = document.getElementById('dropdown-label');
            label.innerText = labelText;
            label.classList.remove('text-gray-400');
            label.classList.add('text-gray-800', 'font-semibold');

            document.getElementById('dropdown-menu').classList.add('hidden');
            document.getElementById('dropdown-arrow').classList.remove('rotate-180');

            // Tampilkan kolom Password & langsung fokus ke inputnya
            const passwordSection = document.getElementById('password-section');
            const passwordInput = document.getElementById('password');
            passwordSection.classList.remove('hidden');
            passwordInput.focus();

            // Aktifkan tombol Login
            const btnSubmit = document.getElementById('btn-submit');
            btnSubmit.disabled = false;
            btnSubmit.classList.remove('bg-[#5a5a5a]', 'cursor-not-allowed');
            btnSubmit.classList.add('bg-[#D21F2B]', 'hover:bg-[#b51924]', 'cursor-pointer');
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        }

        document.addEventListener('click', function(event) {
            const trigger = document.getElementById('dropdown-trigger');
            const menu = document.getElementById('dropdown-menu');
            if (!trigger.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
                document.getElementById('dropdown-arrow').classList.remove('rotate-180');
            }
        });
    </script>
</body>
</html>