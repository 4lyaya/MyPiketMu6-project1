@extends('layouts.auth')

@section('title', 'Login - MyPiketMu6')
@section('subtitle', 'Masuk ke akun Anda')

@section('content')
    <h2 class="text-xl font-semibold text-gray-800 text-center mb-6">Login ke Sistem</h2>

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                </div>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                    placeholder="email@example.com" required autofocus>
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                </div>
                <input type="password" name="password" id="password"
                    class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm"
                    placeholder="Masukkan password" required>
            </div>
        </div>

        <!-- Remember Me -->
        {{-- <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-blue-600 hover:text-blue-500 transition-colors">
                    Lupa password?
                </a>
            @endif
        </div> --}}

        <!-- Submit Button -->
        <div>
            <button type="submit"
                class="w-full bg-blue-700 hover:bg-blue-800 text-white py-3 px-4 rounded-lg font-semibold transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center justify-center">
                <i class="fas fa-sign-in-alt mr-2 text-sm"></i>
                Masuk ke Sistem
            </button>
        </div>
    </form>
@endsection

{{-- @section('auth-link')
    <p class="text-sm">Belum punya akun? <a href="{{ route('register') }}"
            class="text-blue-600 hover:text-blue-500 font-medium transition-colors">Hubungi Administrator</a></p>
@endsection --}}
