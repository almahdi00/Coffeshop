<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kasir {{ request()->is('login') ? 'Login' : 'Register' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-[#1b3c53] via-[#233c6a] to-[#456882] text-white">

    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <div class="bg-[#e3e3e3]/10 backdrop-blur-3xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden">
                
                <!-- Header -->
                <div class="bg-gradient-to-r from-[#1b3c53]/70 to-[#233c6a]/70 px-10 py-12 text-center">
                    <h1 class="text-5xl sm:text-6xl font-extrabold text-[#e3e3e3]">
                        POS KASIR
                    </h1>
                    <p class="mt-4 text-xl text-[#e3e3e3]/80">
                        {{ request()->is('login') ? 'Selamat datang kembali' : 'Buat akun baru' }}
                    </p>
                </div>

                <!-- Form Content -->
                <div class="px-10 py-12">
                    @yield('content')
                </div>

                <!-- Toggle Link -->
                <div class="px-10 pb-10 text-center">
                    @if(request()->is('login'))
                        <p class="text-[#e3e3e3]/70">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="font-semibold text-[#456882] hover:text-[#233c6a] transition">
                                Daftar sekarang
                            </a>
                        </p>
                    @else
                        <p class="text-[#e3e3e3]/70">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="font-semibold text-[#456882] hover:text-[#233c6a] transition">
                                Masuk di sini
                            </a>
                        </p>
                    @endif
                </div>

                <!-- Footer -->
                <div class="bg-black/30 px-10 py-6 text-center text-sm text-[#e3e3e3]/60 border-t border-white/10">
                    © {{ date('Y') }} Kasir MDMart. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</body>
</html>