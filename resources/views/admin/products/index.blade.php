@extends('layouts.app')
@section('header', 'Kelola Produk')

@section('content')
<div class="bg-white shadow-xl rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="p-6 bg-gradient-to-r from-indigo-600 to-purple-600 text-white flex justify-between items-center">
        <h1 class="text-3xl font-bold">DAFTAR PRODUK</h1>
        <a href="{{ route('admin.products.create') }}" 
           class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-bold hover:bg-gray-100 shadow-lg transform hover:scale-105 transition">
            + Tambah Produk
        </a>
    </div>

    {{-- Flash message --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 m-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left min-w-max">
            <thead class="bg-gray-100 border-b-2">
                <tr>
                    <th class="px-6 py-4 font-bold text-gray-700">Sampul</th>
                    <th class="px-6 py-4 font-bold text-gray-700">Nama</th>
                    <th class="px-6 py-4 font-bold text-gray-700">Kategori</th>
                    <th class="px-6 py-4 font-bold text-gray-700">SKU</th>
                    <th class="px-6 py-4 font-bold text-gray-700">Harga</th>
                    <th class="px-6 py-4 font-bold text-gray-700">Stok</th>
                    <th class="px-6 py-4 font-bold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($products as $p)
                <tr class="hover:bg-gray-50 transition">
                    {{-- GAMBAR --}}
                    <td class="px-6 py-4">
                        @if($p->image)
                            <img src="{{ asset('storage/'.$p->image) }}"
                                 class="w-16 h-16 object-cover rounded-lg shadow">
                        @else
                            <div class="w-16 h-16 bg-gray-100 text-gray-400 flex items-center justify-center rounded-lg text-xs">
                                No Image
                            </div>
                        @endif
                    </td>

                    {{-- DATA --}}
                    <td class="px-6 py-4 font-medium">{{ $p->name }}</td>
                    <td class="px-6 py-4">{{ $p->category?->name ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $p->sku }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($p->price) }}</td>
                    <td class="px-6 py-4 text-center font-bold">
                        <span class="{{ $p->stock < 10 ? 'bg-red-100 text-red-600 px-2 py-1 rounded' : '' }}">
                            {{ $p->stock }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="px-6 py-4 space-x-3">
                        <a href="{{ route('admin.products.edit', $p) }}"
                           class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 shadow">
                            Edit
                        </a>

                        <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus {{ $p->name }}?')"
                                    class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 shadow">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="9" class="text-center py-16 text-gray-500 text-xl">
                        Belum ada produk.<br>
                        <a href="{{ route('admin.products.create') }}" class="text-indigo-600 underline">Tambah produk pertama →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
