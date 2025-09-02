@extends('layouts.public')

@section('title', 'Detail Absensi - ' . ($absence->absentTeacher->name ?? 'Tidak Diketahui'))

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Detail Absensi</h1>
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>{{ $absence->replaced_at->format('d F Y') }}</span>
                </div>
            </div>
            <a href="{{ route('public.absences.index') }}"
                class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
            </a>
        </div>

        <!-- Absence Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Guru</h2>

                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-times text-red-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600">Guru Absen</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $absence->absentTeacher->name ?? 'Tidak Diketahui' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-hands-helping text-green-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600">Guru Pengganti</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $absence->substituteTeacher->name ?? 'Tidak ada pengganti' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2">Informasi Mengajar</h2>

                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-school text-blue-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600">Kelas</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $absence->classroom->name ?? 'Tidak Diketahui' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-purple-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-600">Jam Pelajaran</p>
                            <p class="flex flex-wrap gap-1">
                                @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                                    @foreach ($absence->getSelectedPeriods() as $period)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 text-sm font-medium text-blue-700 bg-blue-100 rounded-md">
                                            {{ $period }}
                                        </span>
                                    @endforeach
                                @else
                                    <span class="text-gray-400 text-sm">Tidak ada jam</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Tambahan</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm font-medium text-gray-600">Alasan</p>
                        <p>
                            @if ($absence->reason)
                                <span
                                    class="inline-flex items-center px-3 py-1 text-sm font-medium capitalize bg-blue-100 text-blue-700 rounded-md">
                                    {{ $absence->reason }}
                                </span>
                            @else
                                <span class="text-gray-400 text-sm">Tidak disebutkan</span>
                            @endif
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-sm font-medium text-gray-600">Status</p>
                        <p class="text-gray-800 font-semibold">
                            @if ($absence->substituteTeacher)
                                <span class="text-green-600">Telah Digantikan</span>
                            @else
                                <span class="text-yellow-600">Belum Digantikan</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Notes -->
                @if ($absence->note)
                    <div class="mt-4 bg-blue-50 rounded-lg p-4">
                        <p class="text-sm font-medium text-gray-600 mb-2">Catatan</p>
                        <p class="text-gray-800">{{ $absence->note }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Navigation -->
        {{-- <div class="bg-white rounded-lg shadow p-4">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Data diperbarui: {{ $absence->updated_at->format('d/m/Y H:i') }}
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('public.absences.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors text-sm">
                        <i class="fas fa-list mr-2"></i>Semua Absensi
                    </a>
                </div>
            </div>
        </div> --}}
    </div>
@endsection
