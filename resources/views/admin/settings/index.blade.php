@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('subtitle', 'Tema & format tanggal')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Pengaturan Aplikasi</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Sesuaikan tema dan format tanggal sesuai kebutuhan Anda.</p>
        </div>

        <!-- Tema -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form method="POST" action="{{ route('admin.settings.theme') }}">
                @csrf
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Tema Aplikasi</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pilih antara mode terang atau gelap.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-palette text-primary-600"></i>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <label class="relative">
                        <input type="radio" name="theme" value="light" class="sr-only peer"
                            onchange="this.form.submit()" {{ session('theme', 'light') === 'light' ? 'checked' : '' }}>
                        <div
                            class="p-4 rounded-xl border-2 cursor-pointer transition peer-checked:border-primary-600 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/30 hover:shadow">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-sun text-yellow-500 text-xl"></i>
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-white">Light</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Mode terang</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label class="relative">
                        <input type="radio" name="theme" value="dark" class="sr-only peer"
                            onchange="this.form.submit()" {{ session('theme', 'light') === 'dark' ? 'checked' : '' }}>
                        <div
                            class="p-4 rounded-xl border-2 cursor-pointer transition peer-checked:border-primary-600 peer-checked:bg-primary-50 dark:peer-checked:bg-primary-900/30 hover:shadow">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-moon text-indigo-500 text-xl"></i>
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-white">Dark</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Mode gelap</p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </form>
        </div>

        <!-- Format Tanggal -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form method="POST" action="{{ route('admin.settings.date') }}">
                @csrf
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Format Tanggal</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pilih format tampilan tanggal.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar text-primary-600"></i>
                    </div>
                </div>

                <select name="date_format" onchange="this.form.submit()"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="d-m-Y" {{ session('date_format', 'd-m-Y') == 'd-m-Y' ? 'selected' : '' }}>31-12-2025
                    </option>
                    <option value="Y-m-d" {{ session('date_format', 'd-m-Y') == 'Y-m-d' ? 'selected' : '' }}>2025-12-31
                    </option>
                    <option value="d/m/Y" {{ session('date_format', 'd-m-Y') == 'd/m/Y' ? 'selected' : '' }}>31/12/2025
                    </option>
                    <option value="Y/m/d" {{ session('date_format', 'd-m-Y') == 'Y/m/d' ? 'selected' : '' }}>2025/12/31
                    </option>
                </select>
            </form>
        </div>

        <!-- Akses Cepat -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Akses Cepat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('admin.settings.about') }}"
                    class="flex items-center justify-between p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow transition">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                            <i class="fas fa-info-circle text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800 dark:text-white">Tentang Aplikasi</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Deskripsi & teknologi</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </a>

                <button onclick="window.open('{{ route('admin.exports.form') }}','_self')"
                    class="w-full flex items-center justify-between p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow transition">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <i class="fas fa-file-export text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <p class="font-medium text-gray-800 dark:text-white">Ekspor Data</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Backup Excel/PDF</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </button>
            </div>
        </div>

    </div>
@endsection
