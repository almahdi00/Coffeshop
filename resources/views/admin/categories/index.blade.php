@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold mb-6">Kategori Produk</h1>
<a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Kategori</a>

<table class="w-full border-collapse">
    <thead class="bg-gray-200">
        <tr><th class="p-3 text-left">Nama</th><th class="p-3">Aksi</th></tr>
    </thead>
    <tbody>
        @foreach($categories as $c)
        <tr class="border-b">
            <td class="p-3">{{ $c->name }}</td>
            <td class="p-3">
                <a href="{{ route('admin.categories.edit', $c) }}" class="text-blue-600 mr-3">Edit</a>
                <form action="{{ route('admin.categories.destroy', $c) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Yakin hapus?')" class="text-red-600">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection