@extends('layouts.teachers')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="space-y-6">
        <!-- Welcome Header -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-graduate text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Selamat Datang,
                        {{ $stats['teacher_name'] ?? 'Guru' }}</h1>
                    <p class="text-gray-600 text-sm mt-1">Ringkasan aktivitas mengajar Anda</p>
                </div>
            </div>
        </div>

        <!-- Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Total Ketidakhadiran -->
            <div class="bg-white rounded-lg border border-gray-200 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Ketidakhadiran</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_absences'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2">Jumlah tidak hadir mengajar</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-times text-red-600"></i>
                    </div>
                </div>
            </div>

            <!-- Total Menggantikan -->
            <div class="bg-white rounded-lg border border-gray-200 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Menggantikan</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_substitutions'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2">Jumlah menggantikan guru</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-hands-helping text-green-600"></i>
                    </div>
                </div>
            </div>

            <!-- Kelas yang Diampu -->
            <div class="bg-white rounded-lg border border-gray-200 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Kelas yang Diampu</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_classes'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500 mt-2">Jumlah kelas berbeda</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-school text-blue-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Notes -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Catatan Terbaru</h2>
                    <i class="fas fa-sticky-note text-gray-400"></i>
                </div>

                @if (!empty($stats['latest_notes']))
                    <div class="space-y-3">
                        @foreach ($stats['latest_notes'] as $note)
                            <div class="flex items-start p-3 bg-gray-50 rounded-lg border border-gray-100">
                                <i class="fas fa-comment text-gray-400 mt-0.5 mr-3 text-sm"></i>
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $note }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-400">
                        <i class="fas fa-sticky-note text-3xl mb-3 opacity-50"></i>
                        <p class="text-sm">Belum ada catatan terbaru</p>
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Akses Cepat</h2>
                    <i class="fas fa-bolt text-yellow-500"></i>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('guru.absences.create') }}"
                        class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-100 hover:bg-blue-100 transition-colors group">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center group-hover:bg-blue-700 transition-colors">
                            <i class="fas fa-plus text-white text-sm"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800">Tambah Absensi</p>
                            <p class="text-xs text-gray-500">Buat data absensi baru</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                    </a>

                    <a href="{{ route('guru.absences.index') }}"
                        class="flex items-center p-4 bg-green-50 rounded-lg border border-green-100 hover:bg-green-100 transition-colors group">
                        <div
                            class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center group-hover:bg-green-700 transition-colors">
                            <i class="fas fa-list text-white text-sm"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800">Daftar Absensi</p>
                            <p class="text-xs text-gray-500">Lihat semua absensi</p>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 ml-auto"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Information Card -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-3"></i>
                <div>
                    <p class="text-sm font-medium text-blue-800">Informasi Sistem</p>
                    <p class="text-xs text-blue-600 mt-1">
                        Data diperbarui secara real-time. Pastikan melaporkan ketidakhadiran tepat waktu.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
