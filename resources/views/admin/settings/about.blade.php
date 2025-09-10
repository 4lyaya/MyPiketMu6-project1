@extends('layouts.admin')

@section('title', 'Tentang Aplikasi')
@section('subtitle', 'Informasi aplikasi absensi guru')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

        <!-- Header -->
        <div class="text-center">
            <img src="{{ asset('images/school-logo.png') }}" alt="Logo Sekolah"
                class="w-20 h-20 mx-auto mb-4 rounded-full shadow">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">{{ $app['nama'] }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Versi {{ $app['versi'] }} · Tahun {{ $app['tahun'] }}</p>
        </div>

        <!-- Deskripsi Aplikasi -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-3">Deskripsi Aplikasi</h2>
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                {{ $app['deskripsi'] }}
            </p>
            <div class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                Dikembangkan oleh <span class="font-medium">{{ $app['developer'] }}</span> - Tahun {{ $app['tahun'] }}.
            </div>
        </div>

        <!-- Teknologi yang Digunakan -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Teknologi yang Digunakan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-300">
                <div>
                    <p><span class="font-medium text-gray-800 dark:text-white">Backend:</span> Laravel 11 + PHP 8.3</p>
                    <p><span class="font-medium text-gray-800 dark:text-white">Frontend:</span> Tailwind CSS 3, Flowbite,
                        Alpine.js</p>
                    <p><span class="font-medium text-gray-800 dark:text-white">Export PDF:</span> mPDF</p>
                </div>
                <div>
                    <p><span class="font-medium text-gray-800 dark:text-white">Export Excel:</span> Laravel Excel
                        (maatwebsite/excel)</p>
                    <p><span class="font-medium text-gray-800 dark:text-white">Database:</span> MySQL 8</p>
                    <p><span class="font-medium text-gray-800 dark:text-white">Dark Mode:</span> Tailwind dark: class +
                        localStorage</p>
                </div>
            </div>
        </div>

        <!-- Fitur Unggulan -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Fitur Unggulan</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-600 dark:text-gray-300">
                <li>Manajemen absensi guru secara real-time</li>
                <li>Pencatatan pengganti mengajar otomatis</li>
                <li>Export data ke PDF & Excel (per tabel / full backup)</li>
                <li>Mode gelap (dark mode) yang dapat diaktifkan kapan saja</li>
                <li>Format tanggal dapat disesuaikan</li>
                <li>Responsif di semua perangkat (mobile, tablet, desktop)</li>
            </ul>
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition shadow">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>

    </div>
@endsection
