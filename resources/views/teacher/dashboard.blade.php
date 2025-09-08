@extends('layouts.teachers')

@section('title', 'Dashboard Guru')
@section('subtitle', 'Ringkasan aktivitas mengajar Anda')

@section('content')
    <div class="space-y-6">

        <!-- Welcome Header -->
        <div class="bg-gradient-to-br from-primary-600 to-primary-700 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-graduate text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold">
                            Selamat Datang,
                            {{ Auth::check() && Auth::user()->role === 'guru' ? Auth::user()->name : 'Guru' }}
                        </h1>
                        <p class="text-primary-100 text-sm mt-1">Semangat mengajar hari ini!</p>
                    </div>
                </div>
                <div class="bg-white/10 rounded-xl px-4 py-3 text-right">
                    <p class="text-primary-100 text-xs">Hari ini</p>
                    <p class="text-white font-semibold">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <!-- Total Ketidakhadiran -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Total Ketidakhadiran</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $absentTeachers->count() }}</p>
                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                            <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                            Jumlah tidak hadir mengajar
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-user-times text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Menggantikan -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Total Menggantikan</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalSubstitutions ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Jumlah menggantikan guru
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-hands-helping text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Kelas yang Diampu -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Kelas yang Diampu</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalClasses ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2 flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                            Jumlah kelas berbeda
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-school text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Notes -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-sticky-note text-primary-600 mr-3"></i>
                        Catatan Terbaru
                    </h2>
                    <span class="bg-primary-100 text-primary-700 text-xs font-medium px-2.5 py-1 rounded-full">
                        {{ count($stats['latest_notes'] ?? []) }}
                    </span>
                </div>

                @if (!empty($stats['latest_notes']))
                    <div class="space-y-4">
                        @foreach ($stats['latest_notes'] as $index => $note)
                            <div class="flex items-start p-4 bg-gray-50 rounded-xl border border-gray-200">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                    <span class="text-primary-700 text-sm font-bold">{{ $index + 1 }}</span>
                                </div>
                                <p class="text-gray-700 text-sm leading-relaxed flex-1">{{ $note }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-400">
                        <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-sticky-note text-2xl"></i>
                        </div>
                        <p class="text-sm">Belum ada catatan terbaru</p>
                        <p class="text-xs mt-1">Catatan akan muncul di sini</p>
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                        Akses Cepat
                    </h2>
                    <i class="fas fa-rocket text-gray-300"></i>
                </div>

                <div class="space-y-4">
                    <a href="{{ route('guru.absences.create') }}"
                        class="flex items-center p-4 bg-primary-50 rounded-xl border border-primary-200 hover:bg-primary-100 transition-colors group">
                        <div
                            class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center group-hover:bg-primary-700 transition-colors">
                            <i class="fas fa-plus text-white text-lg"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-semibold text-gray-800">Tambah Absensi</p>
                            <p class="text-xs text-gray-500 mt-1">Buat data absensi baru</p>
                        </div>
                        <i class="fas fa-chevron-right text-primary-400 group-hover:text-primary-600 transition-colors"></i>
                    </a>

                    <a href="{{ route('guru.absences.index') }}"
                        class="flex items-center p-4 bg-green-50 rounded-xl border border-green-200 hover:bg-green-100 transition-colors group">
                        <div
                            class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center group-hover:bg-green-700 transition-colors">
                            <i class="fas fa-list text-white text-lg"></i>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-semibold text-gray-800">Daftar Absensi</p>
                            <p class="text-xs text-gray-500 mt-1">Lihat semua absensi</p>
                        </div>
                        <i class="fas fa-chevron-right text-green-400 group-hover:text-green-600 transition-colors"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Information Card -->
        <div class="bg-primary-50 border border-primary-200 rounded-2xl p-5">
            <div class="flex items-start">
                <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-info-circle text-white"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-semibold text-primary-800 mb-1">Informasi Sistem</p>
                    <p class="text-xs text-primary-700">
                        Data diperbarui secara real-time. Pastikan melaporkan ketidakhadiran tepat waktu untuk kelancaran
                        proses belajar mengajar.
                    </p>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-800 mb-5 flex items-center">
                <i class="fas fa-history text-gray-500 mr-3"></i>
                Aktivitas Terbaru
            </h2>
            <div class="text-center py-8 text-gray-400">
                <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
                <p class="text-sm">Fitur aktivitas terbaru akan segera hadir</p>
                <p class="text-xs mt-1">Pantau perkembangan aktivitas mengajar Anda</p>
            </div>
        </div>
    </div>
@endsection
