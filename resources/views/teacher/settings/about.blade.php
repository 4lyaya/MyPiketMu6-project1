@extends('layouts.teachers')

@section('title', 'Tentang Aplikasi')
@section('subtitle', 'Informasi aplikasi absensi guru')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Card Utama -->
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 md:p-10 space-y-10">

            <!-- Header -->
            <div class="text-center">
                <img src="{{ $app['logo'] }}" alt="Logo" class="w-20 h-20 mx-auto mb-4 rounded-full">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $app['nama'] }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Versi {{ $app['versi'] }} · {{ $app['tahun'] }}</p>
            </div>

            <!-- Deskripsi -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Deskripsi</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ $app['deskripsi'] }}</p>
            </div>

            <!-- Informasi Sekolah -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Informasi Sekolah</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-600 dark:text-gray-300">
                    <div><span class="font-medium">Nama:</span> {{ $app['sekolah']['nama'] }}</div>
                    <div><span class="font-medium">Telepon:</span> {{ $app['sekolah']['telepon'] }}</div>
                    <div class="md:col-span-2"><span class="font-medium">Alamat:</span> {{ $app['sekolah']['alamat'] }}
                    </div>
                    <div><span class="font-medium">Email:</span> {{ $app['sekolah']['email'] }}</div>
                    <div><span class="font-medium">Website:</span>
                        <a href="{{ $app['sekolah']['website'] }}" target="_blank"
                            class="text-blue-600 dark:text-blue-400 hover:underline">{{ $app['sekolah']['website'] }}</a>
                    </div>
                </div>
            </div>

            <!-- Fitur Aplikasi -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Fitur Aplikasi</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ($app['fitur'] as $f)
                        <div class="flex items-start gap-3 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-700 dark:text-gray-300">{{ $f }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tim Developer -->
            <div>
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Tim Developer</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($app['tim'] as $t)
                        <div
                            class="flex items-center gap-4 p-4 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl border border-indigo-100 dark:border-indigo-800">
                            <div
                                class="w-12 h-12 rounded-full bg-white dark:bg-gray-800 shadow flex items-center justify-center">
                                <i class="fas fa-user text-indigo-600 dark:text-indigo-400"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900 dark:text-white">{{ $t['nama'] }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $t['role'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="text-center">
                <a href="{{ route('guru.dashboard') }}"
                    class="px-6 py-3 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition flex items-center justify-center gap-2 max-w-xs mx-auto">
                    <i class="fas fa-home"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>
        </div>
    </div>
@endsection
