@extends('layouts.auth')

@section('title', 'Login - MyPiketMu6')

@section('auth-content')
    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Email Input -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400 text-sm"></i>
                </div>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl input-focus-effect focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-sm placeholder-gray-400"
                    placeholder="email@example.com" required autofocus>
            </div>
        </div>

        <!-- Password Input -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400 text-sm"></i>
                </div>
                <input type="password" name="password" id="password"
                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl input-focus-effect focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-sm placeholder-gray-400"
                    placeholder="Masukkan password" required>
            </div>
        </div>

        <!-- Remember Me (Optional) -->
        {{-- <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-blue-600 hover:text-blue-800 transition-colors">
                    Lupa password?
                </a>
            @endif
        </div> --}}

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white py-3.5 px-4 rounded-xl font-semibold btn-hover-effect focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center justify-center transition-all duration-300">
                <i class="fas fa-sign-in-alt mr-3 text-sm"></i>
                Masuk ke Sistem
            </button>
        </div>
    </form>

    <!-- Additional Links -->
    {{-- <div class="mt-6 pt-5 border-t border-gray-100 text-center">
        <p class="text-sm text-gray-600">
            Butuh bantuan?
            <a href="#" class="text-blue-600 font-medium hover:text-blue-800 transition-colors">
                Hubungi administrator
            </a>
        </p>
    </div> --}}
@endsection
