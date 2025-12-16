<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang - MDMart Kasir</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-purple-950 via-black to-pink-950 flex items-center justify-center">

    <div class="text-center">
        <h1 class="text-7xl font-extrabold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent mb-8">
            MDMART KASIR
        </h1>
        <p class="text-2xl text-gray-300 mb-12">Sistem kasir online modern untuk toko Anda</p>

        <div class="space-x-6">
            <a href="{{ route('login') }}" 
               class="inline-block bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold text-xl px-12 py-6 rounded-xl shadow-2xl transform hover:scale-105 transition duration-300">
                Masuk
            </a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" 
               class="inline-block bg-white/10 backdrop-blur border border-white/30 text-white font-bold text-xl px-12 py-6 rounded-xl hover:bg-white/20 transition">
                Daftar Baru
            </a>
            @endif
        </div>

        <p class="text-gray-400 mt-16 text-sm">
            © {{ date('Y') }} MDMart Kasir • Dibuat dengan ❤️
        </p>
    </div>

</body>
</html>