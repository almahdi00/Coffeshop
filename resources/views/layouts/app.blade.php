<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffeshop - @yield('title', 'POS')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <style>
@media print {
    form, button, nav, footer {
        display: none;
    }
    body {
        background: #fff !important;
        color: #000 !important;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    table, th, td {
        border: 1px solid #000;
    }
}
</style>


</head>
<body class="h-full bg-gray-50 font-sans antialiased">

<div class="min-h-full flex flex-col">
    <!-- Navbar -->
    <nav class="bg-indigo-700 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('pos') }}" class="text-2xl font-bold text-white">Coffe Shop</a>

                    @auth
                        @if(auth()->user()->hasRole('kasir'))
                            <a href="{{ route('pos') }}"
                               class="text-indigo-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('pos*') ? 'bg-indigo-800 text-white' : '' }}">
                                POS
                            </a>
                        @endif

                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.products.index') }}"
                               class="text-indigo-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.products*') ? 'bg-indigo-800 text-white' : '' }}">
                                Produk
                            </a>
                            <a href="{{ route('admin.laporan.index') }}"
                               class="text-indigo-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.laporan*') ? 'bg-indigo-800 text-white' : '' }}">
                                Laporan
                            </a>
                            <a href="{{ route('admin.categories.index') }}"
                            class="text-indigo-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-800 text-white' : '' }}">
                               Category
                            </a>

                        @endif
                    @endauth
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-white text-sm">
                        Halo, <strong>{{ auth()->user()->name }}</strong>
                        ({{ auth()->user()->getRoleNames()->first() ?? 'User' }})
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            © {{ date('Y') }} MDMart. All rights reserved.
        </div>
    </footer>
</div>

</body>
</html>