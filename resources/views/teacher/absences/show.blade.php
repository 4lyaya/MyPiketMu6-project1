@extends('layouts.teachers')

@section('title', 'Detail Absensi')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Absensi</h1>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap data absensi</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('guru.absences.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ route('guru.absences.edit', $absence) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
            </div>
        </div>

        <!-- Detail Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 space-y-6">
                <!-- Grid Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div class="flex items-start justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-500">Tanggal</span>
                            <span
                                class="text-sm font-semibold text-gray-900">{{ $absence->replaced_at->format('d F Y') }}</span>
                        </div>
                        <div class="flex items-start justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-500">Guru Absen</span>
                            <span
                                class="text-sm font-semibold text-gray-900">{{ $absence->absentTeacher->name ?? '-' }}</span>
                        </div>
                        <div class="flex items-start justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-500">Guru Pengganti</span>
                            <span
                                class="text-sm font-semibold {{ $absence->substituteTeacher ? 'text-green-600' : 'text-gray-400' }}">
                                {{ $absence->substituteTeacher->name ?? 'Belum ada pengganti' }}
                            </span>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <div class="flex items-start justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-500">Kelas</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $absence->classroom->name ?? '-' }}</span>
                        </div>
                        <div class="flex items-start justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-500">Jam Pelajaran</span>
                            <div class="text-right">
                                @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                                    <div class="flex flex-wrap gap-1 justify-end">
                                        @foreach ($absence->getSelectedPeriods() as $period)
                                            <span
                                                class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-md">
                                                {{ $period }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-sm text-gray-400">-</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-start justify-between py-3 border-b border-gray-100">
                            <span class="text-sm font-medium text-gray-500">Alasan</span>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800 capitalize">
                                {{ $absence->reason ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                @if ($absence->note)
                    <div class="pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Catatan</h3>
                        <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                            <p class="text-sm text-gray-700 leading-relaxed">{{ $absence->note }}</p>
                        </div>
                    </div>
                @endif

                <!-- Meta Info -->
                <div class="pt-6 border-t border-gray-200 flex flex-wrap gap-4 text-xs text-gray-500">
                    <span>Dibuat: {{ $absence->created_at->format('d/m/Y H:i') }}</span>
                    <span>Diupdate: {{ $absence->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="bg-primary-50 border border-primary-200 rounded-2xl p-5">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-lg bg-primary-600 flex items-center justify-center text-white">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-primary-800 mb-1">Informasi</p>
                    <p class="text-xs text-primary-700">
                        Data absensi telah tersimpan. Pastikan informasi sudah benar sebelum melakukan perubahan.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
