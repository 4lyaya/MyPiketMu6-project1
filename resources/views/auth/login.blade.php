@extends('layouts.auth')

@section('title', 'Login - MyPiketMu')

@section('auth-content')
    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-envelope text-gray-400"></i>
                </div>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm"
                    placeholder="email@example.com">
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-lock text-gray-400"></i>
                </div>
                <input type="password" name="password" id="password" required
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 text-sm"
                    placeholder="Masukkan password">
            </div>
        </div>

        <!-- Submit -->
        <div>
            <button type="submit"
                class="w-full bg-primary-600 text-white rounded-lg py-3 px-4 font-semibold hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition">
                <i class="fas fa-sign-in-alt mr-2"></i>
                Masuk ke Sistem
            </button>
        </div>
    </form>
@endsection
