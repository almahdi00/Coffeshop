@extends('layouts.guest')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-200">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="mt-1 w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 text-white placeholder-gray-400">
            @error('email') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-200">Password</label>
            <input type="password" name="password" required
                   class="mt-1 w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-cyan-400 text-white placeholder-gray-400">
            @error('password') <p class="mt-1 text-sm text-red-400">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center text-sm text-gray-300">
                <input type="checkbox" name="remember" class="rounded border-gray-600 text-cyan-400 focus:ring-cyan-400">
                <span class="ml-2">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-cyan-300 hover:text-cyan-200">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit"
                class="w-full py-4 bg-gradient-to-r from-cyan-500 to-purple-500 hover:from-cyan-600 hover:to-purple-600 rounded-xl font-bold text-lg shadow-lg transition">
            MASUK
        </button>
    </div>
</form>
@endsection