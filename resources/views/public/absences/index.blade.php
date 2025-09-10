@extends('layouts.public')

@php
    use Carbon\Carbon;

    $dateValue = request('date') ? Carbon::parse(request('date'))->format('Y-m-d') : '';
@endphp

@section('title', 'Daftar Absensi Guru')
@section('breadcrumb', 'Daftar Absensi')

@section('content')
    <div class="space-y-6">

        <!-- Header Section -->
        <div class="text-center mb-8 md:mb-10 px-4">
            <div class="relative">
                <!-- Background decoration -->
                <div
                    class="absolute -top-6 -left-10 w-24 h-24 bg-blue-100/30 dark:bg-blue-900/20 rounded-full blur-xl opacity-70">
                </div>
                <div
                    class="absolute -top-2 -right-8 w-16 h-16 bg-indigo-100/40 dark:bg-indigo-900/20 rounded-full blur-lg opacity-60">
                </div>

                <!-- Main content -->
                <div class="relative z-10">
                    <!-- Badge -->
                    <div
                        class="inline-flex items-center px-4 py-1.5 rounded-full bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800 mb-5">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-sm font-medium text-blue-700 dark:text-blue-300">Sistem Informasi Guru</span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-800 dark:text-white mb-4 leading-tight">
                        Daftar <span class="text-blue-600 dark:text-blue-400">Absensi Guru</span>
                    </h1>

                    <!-- Description -->
                    <p class="text-lg sm:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed mb-6">
                        Informasi ketidakhadiran dan penggantian jam mengajar secara real-time
                    </p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 sm:p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                <i class="fas fa-filter mr-2 text-blue-500 dark:text-blue-400"></i>Filter Data
            </h2>

            <form action="{{ route('public.absences.index') }}" method="GET"
                class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

                <!-- Tanggal -->
                <div class="flex flex-col">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal</label>
                    <input type="date" name="date" value="{{ $dateValue }}"
                        class="w-full px-4 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors h-[42px]">
                </div>

                <!-- Guru -->
                <div class="flex flex-col">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Guru</label>
                    <select name="teacher"
                        class="w-full px-4 py-2.5 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition-colors h-[42px]">
                        <option value="">Semua Guru</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ request('teacher') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name ?? 'Unknown Teacher' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Terapkan Filter -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg transition-colors text-sm font-medium flex items-center justify-center shadow-sm h-[42px]">
                        <i class="fas fa-filter mr-2"></i>Terapkan Filter
                    </button>
                </div>

                <!-- Tombol Reset -->
                <div>
                    <a href="{{ route('public.absences.index') }}"
                        class="w-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 py-2.5 px-4 rounded-lg transition-colors text-sm font-medium flex items-center justify-center shadow-sm h-[42px]">
                        <i class="fas fa-redo mr-2"></i>Reset Filter
                    </a>
                </div>
            </form>

            <!-- Quick Date Filters -->
            <div class="mt-5 pt-4 border-t border-gray-100 dark:border-gray-700">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter Cepat:</span>
                <div class="flex flex-wrap gap-2 mt-2">
                    <a href="{{ route('public.absences.index', ['date' => now()->format('Y')]) }}"
                        class="px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors text-xs font-medium shadow-sm">
                        Tahun Ini ({{ now()->format('Y') }})
                    </a>
                    <a href="{{ route('public.absences.index', ['date' => now()->format('Y-m')]) }}"
                        class="px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors text-xs font-medium shadow-sm">
                        Bulan Ini ({{ now()->translatedFormat('F Y') }})
                    </a>
                    <a href="{{ route('public.absences.index', ['date' => now()->format('Y-m-d')]) }}"
                        class="px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors text-xs font-medium shadow-sm">
                        Hari Ini ({{ now()->format('d/m/Y') }})
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 text-center transition-transform hover:translate-y-[-2px]">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-50 dark:bg-blue-900/30 mb-3">
                    <i class="fas fa-clipboard-list text-blue-600 dark:text-blue-400 text-lg"></i>
                </div>
                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">{{ $totalAbsences }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Total Absensi</div>
            </div>
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 text-center transition-transform hover:translate-y-[-2px]">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-50 dark:bg-green-900/30 mb-3">
                    <i class="fas fa-user-check text-green-600 dark:text-green-400 text-lg"></i>
                </div>
                <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-1">{{ $totalSubstitutions }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Guru Pengganti</div>
            </div>
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 text-center transition-transform hover:translate-y-[-2px]">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-indigo-50 dark:bg-indigo-900/30 mb-3">
                    <i class="fas fa-users text-indigo-600 dark:text-indigo-400 text-lg"></i>
                </div>
                <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mb-1">{{ $uniqueTeachers }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Guru Absen</div>
            </div>
        </div>

        <!-- Absences Table -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <!-- Table Header for Mobile -->
            <div class="p-4 border-b border-gray-100 dark:border-gray-700 md:hidden">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Daftar Absensi Guru</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $absences->total() }} data ditemukan</p>
            </div>

            <div class="overflow-x-auto">
                <!-- Desktop Table -->
                <table class="w-full text-sm hidden md:table">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider whitespace-nowrap">
                                No
                            </th>
                            <th
                                class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider whitespace-nowrap">
                                Tanggal diBuat
                            </th>
                            <th
                                class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider whitespace-nowrap">
                                Guru Absen
                            </th>
                            <th
                                class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider whitespace-nowrap">
                                Pengganti
                            </th>
                            <th
                                class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider whitespace-nowrap">
                                Kelas
                            </th>
                            <th
                                class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider whitespace-nowrap">
                                Jam
                            </th>
                            <th
                                class="px-6 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider whitespace-nowrap">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($absences as $absence)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900 dark:text-white text-sm">
                                        {{ ($absences->currentPage() - 1) * $absences->perPage() + $loop->iteration }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900 dark:text-white text-sm">
                                        {{ $absence->created_at ? $absence->created_at->format('d/m/Y') : 'Tanggal tidak valid' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="text-sm text-gray-800 dark:text-gray-200">{{ $absence->absentTeacher->name ?? 'Guru tidak diketahui' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($absence->substituteTeacher)
                                        <div class="flex items-center">
                                            <div
                                                class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center mr-2">
                                                <i class="fas fa-user text-green-600 dark:text-green-400 text-xs"></i>
                                            </div>
                                            <span
                                                class="text-sm text-gray-800 dark:text-gray-200">{{ $absence->substituteTeacher->name }}</span>
                                        </div>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                                            <i class="fas fa-clock mr-1"></i> Menunggu
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                        <i class="fas fa-door-open mr-1"></i>
                                        {{ $absence->classroom->name ?? 'Kelas tidak diketahui' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                                        <div class="flex flex-wrap gap-1.5 max-w-[150px]">
                                            @foreach ($absence->getSelectedPeriods() as $period)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 border border-blue-100 dark:border-blue-800">
                                                    <i class="fas fa-clock mr-1 text-xs"></i>{{ $period }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500 text-sm italic">Tidak ada jam</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('public.absences.show', $absence) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors text-xs font-medium shadow-sm">
                                        <i class="fas fa-eye mr-1.5 text-xs"></i>
                                        <span>Detail</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
                                            <i class="fas fa-clipboard-list text-2xl text-gray-300 dark:text-gray-500"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tidak ada data
                                            absensi</p>
                                        <p class="text-xs text-gray-400 dark:text-gray-500">Coba gunakan filter yang
                                            berbeda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Mobile Cards -->
                <div class="md:hidden">
                    @forelse($absences as $absence)
                        <div
                            class="border-b border-gray-100 dark:border-gray-700 p-4 last:border-b-0 hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                            <div class="grid grid-cols-1 gap-3">
                                <!-- Header -->
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">
                                            {{ $absence->created_at ? $absence->created_at->format('d/m/Y') : 'Tanggal tidak valid' }}
                                        </div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                            {{ $absence->absentTeacher->name ?? 'Guru tidak diketahui' }}
                                        </div>
                                    </div>
                                    <a href="{{ route('public.absences.show', $absence) }}"
                                        class="inline-flex items-center px-2.5 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-md text-xs font-medium">
                                        <i class="fas fa-eye mr-1 text-xs"></i>
                                        Detail
                                    </a>
                                </div>

                                <!-- Content -->
                                <div class="grid grid-cols-1 gap-2">
                                    <!-- Pengganti -->
                                    <div class="flex items-center">
                                        <span
                                            class="text-xs font-medium text-gray-600 dark:text-gray-400 w-20">Pengganti:</span>
                                        @if ($absence->substituteTeacher)
                                            <span
                                                class="text-sm text-gray-800 dark:text-gray-200">{{ $absence->substituteTeacher->name }}</span>
                                        @else
                                            <span
                                                class="text-xs text-yellow-600 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900/30 px-2 py-1 rounded-full">
                                                Menunggu pengganti
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Kelas -->
                                    <div class="flex items-center">
                                        <span
                                            class="text-xs font-medium text-gray-600 dark:text-gray-400 w-20">Kelas:</span>
                                        <span
                                            class="text-sm text-gray-800 dark:text-gray-200">{{ $absence->classroom->name ?? 'Kelas tidak diketahui' }}</span>
                                    </div>

                                    <!-- Jam -->
                                    <div class="flex items-start">
                                        <span class="text-xs font-medium text-gray-600 dark:text-gray-400 w-20">Jam:</span>
                                        <div class="flex-1">
                                            @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach ($absence->getSelectedPeriods() as $period)
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 border border-blue-100 dark:border-blue-800 mb-1">
                                                            <i class="fas fa-clock mr-1 text-xs"></i>{{ $period }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500 text-sm italic">Tidak ada
                                                    jam</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <div
                                class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-clipboard-list text-2xl text-gray-300 dark:text-gray-500"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tidak ada data absensi</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">Coba gunakan filter yang berbeda</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            @if ($absences->hasPages())
                <div
                    class="bg-white dark:bg-gray-800 px-5 py-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                    {{ $absences->appends(request()->query())->links('components.pagination') }}
                </div>
            @endif

            <!-- Information Box -->
            {{-- <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800 rounded-xl p-5">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/50 flex items-center justify-center">
                            <i class="fas fa-info text-blue-500 dark:text-blue-400"></i>
                        </div>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800 dark:text-blue-300">Informasi</h3>
                        <p class="text-sm text-blue-600 dark:text-blue-400 mt-1">
                            Data absensi diperbarui secara real-time. Untuk informasi lebih lanjut, hubungi administrasi
                            sekolah.
                        </p>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
