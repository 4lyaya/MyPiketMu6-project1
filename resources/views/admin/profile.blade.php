@extends('layouts.admin')
@section('title', 'Profil Admin')
@section('subtitle', 'Kelola akun Anda')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Update Profil -->
        <form method="POST" action="{{ route('admin.profile.update') }}"
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
            @csrf @method('PUT')
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Data Profil</h3>
            <div class="space-y-4">
                <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Email"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>
            <button type="submit" class="mt-4 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                Simpan Perubahan
            </button>
        </form>

        <!-- Ganti Password -->
        <form method="POST" action="{{ route('admin.profile.password') }}"
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            @csrf @method('PUT')
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Ganti Password</h3>
            <div class="space-y-4">
                <input type="password" name="current_password" placeholder="Password Lama"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                <input type="password" name="password" placeholder="Password Baru"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>
            <button type="submit"
                class="mt-4 px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                Update Password
            </button>
        </form>
    </div>
@endsection
