<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir.in</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;800&display=swap" rel="stylesheet">
    <!-- Fallback CDN Tailwind jika vite belum dijalankan -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-[#D21F2B] h-screen w-screen flex items-center justify-center overflow-hidden">
    
    <!-- Teks Brand Raksasa di Tengah -->
    <h1 class="text-white text-6xl md:text-8xl lg:text-[11rem] font-extrabold tracking-tight select-none">
        kasir.in
    </h1>
    <script>
    // Berpindah otomatis ke halaman login setelah 3 detik (3000 ms)
    setTimeout(function() {
        window.location.href = "{{ route('login') }}";
        // Jika nama rutenya belum didefinisikan, bisa gunakan URL langsung:
        // window.location.href = '/login';
    }, 5000);
</script>
</body>
</html>