@extends('layouts.admin')

@section('title', 'Detail Absensi')

@section('content')
    <div class="max-w-3xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Detail Absensi</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Informasi lengkap data absensi guru</p>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                Dibuat pada: {{ $absence->created_at->format('d M Y H:i') }}
            </p>
        </div>

        <!-- Detail Card -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-5 space-y-4">
                <!-- Tanggal -->
                <div class="flex items-start gap-4">
                    <div class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Digantikan</div>
                    <div class="flex-1 text-sm text-gray-900 dark:text-gray-100 font-semibold">
                        {{ $absence->replaced_at ? \Carbon\Carbon::parse($absence->replaced_at)->translatedFormat('d F Y') : '-' }}
                    </div>
                </div>

                <!-- Guru Absen -->
                <div class="flex items-start gap-4">
                    <div class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Guru Absen</div>
                    <div class="flex-1 text-sm text-gray-900 dark:text-gray-100">{{ $absence->absentTeacher->name ?? '-' }}
                    </div>
                </div>

                <!-- Guru Pengganti -->
                <div class="flex items-start gap-4">
                    <div class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Guru Pengganti</div>
                    <div class="flex-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $absence->substituteTeacher->name ?? '-' }}</div>
                </div>

                <!-- Kelas -->
                <div class="flex items-start gap-4">
                    <div class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Kelas</div>
                    <div class="flex-1 text-sm text-gray-900 dark:text-gray-100">{{ $absence->classroom->name ?? '-' }}
                    </div>
                </div>

                <!-- Jam -->
                <div class="flex items-start gap-4">
                    <div class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Jam</div>
                    <div class="flex-1 text-sm text-gray-900 dark:text-gray-100 flex flex-wrap gap-1">
                        @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                            @foreach ($absence->getSelectedPeriods() as $period)
                                <span
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-md">
                                    {{ $period }}
                                </span>
                            @endforeach
                        @else
                            <span>-</span>
                        @endif
                    </div>
                </div>

                <!-- Alasan -->
                <div class="flex items-start gap-4">
                    <div class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Alasan</div>
                    <div class="flex-1">
                        <div class="text-sm text-gray-900 dark:text-gray-100 max-w-md truncate bg-blue-100 dark:bg-blue-900/30 px-4 py-2.5 rounded-md"
                            title="{{ $absence->reason }}">
                            {{ $absence->reason ?? '-' }}
                        </div>
                    </div>
                </div>

                <!-- Catatan -->
                <div class="flex items-start gap-4">
                    <div class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Catatan</div>
                    <div class="flex-1">
                        <div class="text-sm text-gray-900 dark:text-gray-100 max-w-md truncate bg-gray-100 dark:bg-gray-700/50 px-4 py-2.5 rounded-md"
                            title="{{ $absence->note }}">
                            {{ $absence->note ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div
                class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.absences.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ route('admin.absences.edit', $absence) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg bg-primary-600 text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection
