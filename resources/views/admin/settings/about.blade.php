@extends('layouts.admin')

@section('title', 'Tentang Aplikasi')
@section('subtitle', 'Informasi aplikasi absensi guru')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">

        <!-- Hero Section -->
        <div
            class="relative text-center bg-gradient-to-br from-blue-50 to-blue-50 dark:from-blue-900/20 dark:to-blue-900/20 rounded-3xl p-8 sm:p-12 border border-blue-100 dark:border-blue-800 shadow-inner">
            <img src="{{ asset('images/school-logo.png') }}" alt="Logo Sekolah"
                class="w-24 h-24 mx-auto mb-6 rounded-full shadow-lg">
            <h1
                class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-600 dark:from-blue-400 dark:to-blue-400">
                {{ $app['nama'] }}</h1>
            <p class="mt-3 text-base md:text-lg text-gray-600 dark:text-gray-300">Versi {{ $app['versi'] }} · Tahun
                {{ $app['tahun'] }}</p>
            <p class="mt-4 max-w-2xl mx-auto text-gray-600 dark:text-gray-300 leading-relaxed">{{ $app['deskripsi'] }}</p>
            <div class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                Dikembangkan oleh <span
                    class="font-semibold text-blue-600 dark:text-blue-400">{{ $app['developer'] }}</span>
            </div>
        </div>

        <!-- Fitur Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ([['icon' => 'fa-clock', 'title' => 'Real-Time', 'desc' => 'Absensi guru langsung tercatat.'], ['icon' => 'fa-user-check', 'title' => 'Otomatis', 'desc' => 'Pengganti mengajar otomatis.'], ['icon' => 'fa-file-export', 'title' => 'Export', 'desc' => 'Unduh Excel & PDF per tabel.'], ['icon' => 'fa-moon', 'title' => 'Dark Mode', 'desc' => 'Tampilan gelap & nyaman.'], ['icon' => 'fa-calendar', 'title' => 'Format Tanggal', 'desc' => 'Bebas pilih format tanggal.'], ['icon' => 'fa-mobile-alt', 'title' => 'Responsive', 'desc' => 'Sempurna di semua layar.']] as $f)
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 text-center hover:shadow-lg transition">
                    <div
                        class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-100 to-blue-100 dark:from-blue-900/30 dark:to-blue-900/30 flex items-center justify-center mx-auto mb-4">
                        <i class="fas {{ $f['icon'] }} text-blue-600 dark:text-blue-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">{{ $f['title'] }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $f['desc'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Teknologi -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Teknologi yang Digunakan</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
                @foreach ([['name' => 'Laravel 11', 'icon' => 'fa-laravel', 'color' => 'text-red-600'], ['name' => 'Tailwind CSS', 'icon' => 'fa-css3-alt', 'color' => 'text-blue-600'], ['name' => 'MySQL 8', 'icon' => 'fa-database', 'color' => 'text-green-600'], ['name' => 'mPDF / Excel', 'icon' => 'fa-file-export', 'color' => 'text-purple-600']] as $tech)
                    <div class="flex flex-col items-center">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center mb-3 shadow-inner">
                            <i class="fab {{ $tech['icon'] }} {{ $tech['color'] }} text-3xl"></i>
                        </div>
                        <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $tech['name'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- CTA Kembali -->
        <div class="text-center">
            <a href="{{ route('admin.settings.index') }}"
                class="inline-flex items-center gap-3 px-6 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition shadow-lg text-base font-semibold">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Pengaturan</span>
            </a>
        </div>
    </div>
@endsection
