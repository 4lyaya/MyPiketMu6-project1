@extends('layouts.teachers')

@section('title', 'Detail Absensi')
@section('breadcrumb', 'Detail Absensi')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Detail Absensi</h1>
                <p class="text-gray-600 text-sm mt-1">Informasi lengkap ketidakhadiran</p>
            </div>
            <div class="flex gap-2 mt-3 sm:mt-0">
                <a href="{{ route('guru.absences.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <a href="{{ route('guru.absences.edit', $absence) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
            </div>
        </div>

        <!-- Detail Card -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informasi Utama -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Utama</h3>

                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600 text-sm">Tanggal</span>
                        <span class="text-gray-800 font-medium">{{ $absence->replaced_at->format('d F Y') }}</span>
                    </div>

                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600 text-sm">Guru Absen</span>
                        <span class="text-gray-800 font-medium">{{ $absence->absentTeacher->name ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600 text-sm">Guru Pengganti</span>
                        <span class="{{ $absence->substituteTeacher ? 'text-green-600 font-medium' : 'text-gray-400' }}">
                            {{ $absence->substituteTeacher->name ?? 'Belum ada pengganti' }}
                        </span>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Tambahan</h3>

                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600 text-sm">Kelas</span>
                        <span class="text-gray-800 font-medium">{{ $absence->classroom->name ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between items-start py-2 border-b border-gray-100">
                        <span class="text-gray-600 text-sm">Jam Pelajaran</span>
                        <div class="text-right">
                            @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                                <div class="flex flex-wrap gap-1 justify-end">
                                    @foreach ($absence->getSelectedPeriods() as $period)
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                            {{ $period }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                        <span class="text-gray-600 text-sm">Alasan</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium capitalize">
                            {{ $absence->reason ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Catatan -->
            @if ($absence->note)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Catatan</h3>
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-100">
                        <p class="text-gray-700 text-sm leading-relaxed">{{ $absence->note }}</p>
                    </div>
                </div>
            @endif

            <!-- Info Waktu -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex flex-wrap gap-4 text-xs text-gray-500">
                    <span>Dibuat: {{ $absence->created_at->format('d/m/Y H:i') }}</span>
                    <span>Diupdate: {{ $absence->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
