@extends('layouts.app')
@section('header', $product->exists ? 'Edit Produk' : 'Tambah Produk')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
    <form
        enctype="multipart/form-data"
        action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
        method="POST">
        @csrf
        @if($product->exists) @method('PUT') @endif

        <div class="grid grid-cols-2 gap-6">

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $product->name) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                           text-gray-900 bg-white focus:ring-indigo-500 focus:border-indigo-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- SKU --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">SKU</label>
                <input
                    type="text"
                    name="sku"
                    value="{{ old('sku', $product->sku) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                           text-gray-900 bg-white focus:ring-indigo-500 focus:border-indigo-500">
                @error('sku')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Harga --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Harga Jual</label>
                <input
                    type="number"
                    name="price"
                    value="{{ old('price', $product->price) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                           text-gray-900 bg-white focus:ring-indigo-500 focus:border-indigo-500">
                @error('price')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Stok --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Stok Awal</label>
                <input
                    type="number"
                    name="stock"
                    value="{{ old('stock', $product->stock ?? 0) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                           text-gray-900 bg-white focus:ring-indigo-500 focus:border-indigo-500">
                @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                               text-gray-900 bg-white focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Gambar Produk --}}
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Sampul Produk</label>
                <input
                    type="file"
                    name="image"
                    accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-700
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0
                           file:bg-indigo-600 file:text-white
                           hover:file:bg-indigo-700">
                @if($product->image)
                    <div class="mt-4">
                        <p class="text-sm text-gray-500 mb-1">Gambar saat ini:</p>
                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            class="h-24 w-24 object-cover rounded border">
                    </div>
                @endif
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Aksi --}}
        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.products.index') }}"
               class="px-6 py-3 border rounded-lg hover:bg-gray-100">Batal</a>
            <button type="submit"
                    class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                {{ $product->exists ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection
