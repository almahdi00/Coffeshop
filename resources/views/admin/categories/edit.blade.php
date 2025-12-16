@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4">Edit Kategori</h2>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Penting agar route resource menerima PUT -->

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium">Nama Kategori</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $category->name) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   placeholder="Masukkan nama kategori">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Update
        </button>
    </form>
</div>
@endsection
