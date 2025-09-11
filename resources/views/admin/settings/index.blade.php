@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('subtitle', 'Tema & format tanggal')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">

        <!-- Hero Section -->
        <div
            class="relative text-center bg-gradient-to-br from-blue-50 to-blue-50 dark:from-blue-900/20 dark:to-blue-900/20 rounded-3xl p-8 sm:p-12 border border-blue-100 dark:border-blue-800 shadow-inner">
            <div
                class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-100 dark:from-blue-900/30 dark:to-blue-900/30 flex items-center justify-center mx-auto mb-6 shadow-inner">
                <i class="fas fa-cog text-blue-600 dark:text-blue-400 text-3xl"></i>
            </div>
            <h1
                class="text-3xl md:text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-600 dark:from-blue-400 dark:to-blue-400 mb-3">
                Pengaturan Aplikasi</h1>
            <p class="text-base md:text-lg text-gray-600 dark:text-gray-300">Sesuaikan tema dan format tanggal sesuai
                kebutuhan Anda.</p>
        </div>

        <!-- Tema Section -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">
            <form method="POST" action="{{ route('admin.settings.theme') }}">
                @csrf
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">Tema Aplikasi</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pilih antara mode terang atau gelap.</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-100 dark:from-blue-900/30 dark:to-blue-900/30 flex items-center justify-center shadow-inner">
                        <i class="fas fa-palette text-blue-600 dark:text-blue-400 text-xl"></i>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <label class="relative">
                        <input type="radio" name="theme" value="light" class="sr-only peer"
                            onchange="this.form.submit()" {{ session('theme', 'light') === 'light' ? 'checked' : '' }}>
                        <div
                            class="p-5 rounded-2xl border-2 cursor-pointer transition peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/30 hover:shadow-lg">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                                    <i class="fas fa-sun text-yellow-600 text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-white">Light</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Mode terang</p>
                                </div>
                            </div>
                        </div>
                    </label>

                    <label class="relative">
                        <input type="radio" name="theme" value="dark" class="sr-only peer"
                            onchange="this.form.submit()" {{ session('theme', 'light') === 'dark' ? 'checked' : '' }}>
                        <div
                            class="p-5 rounded-2xl border-2 cursor-pointer transition peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/30 hover:shadow-lg">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                    <i class="fas fa-moon text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-white">Dark</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Mode gelap</p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </form>
        </div>

        <!-- Format Tanggal Section -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">
            <form method="POST" action="{{ route('admin.settings.date') }}">
                @csrf
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">Format Tanggal</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pilih format tampilan tanggal.</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center shadow-inner">
                        <i class="fas fa-calendar text-gray-600 dark:text-gray-300 text-xl"></i>
                    </div>
                </div>

                <select name="date_format" onchange="this.form.submit()"
                    class="w-full px-5 py-3 border border-gray-300 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-base">
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
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Akses Cepat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <a href="{{ route('admin.settings.about') }}"
                    class="flex items-center justify-between p-5 rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-xl transition">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 flex items-center justify-center shadow-inner">
                            <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-2xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-white">Tentang Aplikasi</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Deskripsi & teknologi</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </a>

                <a href="{{ route('admin.settings.backup') }}"
                    class="flex items-center justify-between p-5 rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-xl transition">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-100 to-green-200 dark:from-green-900/30 dark:to-green-800/30 flex items-center justify-center shadow-inner">
                            <i class="fas fa-file-export text-green-600 dark:text-green-400 text-2xl"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 dark:text-white">Ekspor Data</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Backup Excel/PDF</p>
                        </div>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </a>
            </div>
        </div>

        <!-- Tombol Kembali ke Dashboard -->
        <div class="flex justify-center mt-8">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-3 px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600 transition shadow text-base font-medium">
                <i class="fas fa-home"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>
    </div>
@endsection
