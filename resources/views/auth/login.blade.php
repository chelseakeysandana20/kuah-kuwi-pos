<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kasir.in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-[#D21F2B] h-screen w-screen flex items-center justify-center overflow-hidden relative">

    <!-- Teks Brand Background (Z-Index 0) -->
    <h1 class="absolute z-0 text-white text-6xl md:text-8xl lg:text-[11rem] font-extrabold tracking-tight select-none pointer-events-none opacity-100">
        kasir.in
    </h1>

    <!-- Card Login (Z-Index 10) -->
    <div class="relative z-10 bg-white w-11/12 max-w-[380px] rounded-lg shadow-lg px-8 py-10">
        <h2 class="text-center text-xl font-bold text-gray-800 mb-8">Login form</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Menampilkan Error Pesan Login -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-600 text-xs rounded-md text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Input Username -->
            <div class="mb-5">
                <label for="username" class="block text-[11px] font-medium text-gray-500 mb-1.5">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <!-- Icon User -->
                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                        class="block w-full pl-9 pr-3 py-2 border border-gray-200 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-colors"
                        placeholder="Enter username">
                </div>
            </div>

            <!-- Input Password -->
            <div class="mb-2">
                <label for="password" class="block text-[11px] font-medium text-gray-500 mb-1.5">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <!-- Icon Lock -->
                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input id="password" type="password" name="password" required
                        class="block w-full pl-9 pr-3 py-2 border border-gray-200 rounded-md text-sm placeholder-gray-400 focus:outline-none focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-colors"
                        placeholder="Enter password">
                </div>
            </div>

            <!-- Link Lupa Password -->
            <div class="flex items-center justify-start mb-8">
                <a href="#" class="text-[11px] text-gray-500 hover:text-gray-800 transition-colors">Forgot password?</a>
            </div>

            <!-- Tombol Login (Pill Shape) -->
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-[#5a5a5a] hover:bg-[#444444] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                    Login
                </button>
            </div>
        </form>
    </div>
</body>
</html>