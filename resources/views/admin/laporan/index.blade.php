@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">

    <h1 class="text-3xl font-bold mb-4">Laporan Penjualan</h1>

    <!-- Filter Tanggal -->
    <form method="get" class="flex space-x-3 mb-6">
        <input type="date" name="start" value="{{ $start }}" class="border px-3 py-2 rounded-lg">
        <input type="date" name="end" value="{{ $end }}" class="border px-3 py-2 rounded-lg">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Filter</button>
    </form>

    <!-- Ringkasan -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="text-xl font-bold mb-2">Total Transaksi</h2>
            <p class="text-2xl">{{ $totalTransaksi }}</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <h2 class="text-xl font-bold mb-2">Total Penjualan</h2>
            <p class="text-2xl">Rp {{ number_format($totalPenjualan) }}</p>
        </div>
    </div>

    <!-- Produk Terlaris -->
    <div class="bg-white p-6 rounded-2xl shadow-lg mt-6">
        <h2 class="text-xl font-bold mb-4">Produk Terlaris</h2>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="py-2 px-3">Produk</th>
                    <th class="py-2 px-3">Jumlah Terjual</th>
                    <th class="py-2 px-3">Total Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produkTerlaris as $item)
                <tr class="border-b">
                    <td class="py-2 px-3">{{ $item->product->name ?? '-' }}</td>
                    <td class="py-2 px-3">{{ $item->total_qty }}</td>
                    <td class="py-2 px-3">Rp {{ number_format($item->total_penjualan) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="py-2 px-3 text-center text-gray-500">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <button onclick="window.print()"
        class="mb-4 bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
    Cetak Laporan
</button>

    </div>
</div>
@endsection
