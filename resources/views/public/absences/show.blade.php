@extends('layouts.public')

@section('title', 'Detail Absensi - ' . ($absence->absentTeacher->name ?? 'Tidak Diketahui'))

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 mb-6 border border-blue-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex-1">
                    <!-- Breadcrumb -->
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('public.absences.index') }}"
                                    class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-home mr-2"></i>
                                    Daftar Absensi
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                                    <span class="text-sm font-medium text-gray-500">Detail Absensi</span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <!-- Title -->
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                        Detail <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Absensi
                            Guru</span>
                    </h1>

                    <!-- Date -->
                    <div class="flex items-center text-gray-600">
                        <div class="flex items-center bg-white px-3 py-1.5 rounded-lg shadow-sm border border-gray-100">
                            <i class="fas fa-calendar-day text-blue-500 mr-2"></i>
                            <span
                                class="text-sm font-medium">{{ $absence->created_at->translatedFormat('l, d F Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="mt-4 lg:mt-0">
                    <a href="{{ route('public.absences.index') }}"
                        class="inline-flex items-center px-5 py-2.5 bg-white text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-300 shadow-sm border border-gray-200 hover:shadow-md text-sm font-semibold">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Teacher Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <!-- Section Header -->
                    <div class="bg-gradient-to-r from-blue-50 to-blue-25 px-6 py-4 border-b border-blue-100">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-chalkboard-teacher text-blue-500 mr-3"></i>
                            Informasi Guru
                        </h2>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Absent Teacher -->
                            <div class="bg-red-50/50 border border-red-100 rounded-xl p-5 transition-all hover:shadow-sm">
                                <div class="flex items-start">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-user-times text-red-600 text-lg"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-600 mb-1">Guru Absen</p>
                                        <p class="text-lg font-semibold text-gray-800">
                                            {{ $absence->absentTeacher->name ?? 'Tidak Diketahui' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Substitute Teacher -->
                            <div
                                class="bg-green-50/50 border border-green-100 rounded-xl p-5 transition-all hover:shadow-sm">
                                <div class="flex items-start">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-hands-helping text-green-600 text-lg"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-600 mb-1">Guru Pengganti</p>
                                        <p class="text-lg font-semibold text-gray-800">
                                            {{ $absence->substituteTeacher->name ?? 'Belum ada pengganti' }}
                                        </p>
                                        @if (!$absence->substituteTeacher)
                                            <span
                                                class="inline-block mt-2 px-2.5 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                                <i class="fas fa-clock mr-1"></i>Menunggu
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Teaching Information -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mt-6">
                    <div class="bg-gradient-to-r from-indigo-50 to-indigo-25 px-6 py-4 border-b border-indigo-100">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-book-open text-indigo-500 mr-3"></i>
                            Informasi Mengajar
                        </h2>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Classroom -->
                            <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-5 transition-all hover:shadow-sm">
                                <div class="flex items-start">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-school text-blue-600 text-lg"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-600 mb-1">Kelas</p>
                                        <p class="text-lg font-semibold text-gray-800">
                                            {{ $absence->classroom->name ?? 'Tidak Diketahui' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Replacement Date -->
                            <div class="bg-teal-50/50 border border-teal-100 rounded-xl p-5 transition-all hover:shadow-sm">
                                <div class="flex items-start">
                                    <div
                                        class="flex-shrink-0 w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-calendar-check text-teal-600 text-lg"></i>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-gray-600 mb-1">Tanggal Digantikan</p>
                                        <p class="text-lg font-semibold text-gray-800">
                                            {{ $absence->replaced_at ? \Carbon\Carbon::parse($absence->replaced_at)->translatedFormat('d F Y') : 'Tidak Diketahui' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Periods -->
                        <div class="mt-6 bg-gray-50/50 border border-gray-100 rounded-xl p-5">
                            <div class="flex items-start mb-4">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-clock text-purple-600 text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600 mb-1">Jam Pelajaran</p>
                                    @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @foreach ($absence->getSelectedPeriods() as $period)
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 bg-purple-100 text-purple-700 text-sm font-medium rounded-lg border border-purple-200">
                                                    <i class="fas fa-clock mr-1.5 text-xs"></i>{{ $period }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm italic">Tidak ada jam pelajaran</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Additional Information -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-25 px-6 py-4 border-b border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-info-circle text-gray-500 mr-3"></i>
                            Informasi Tambahan
                        </h2>
                    </div>

                    <div class="p-6">
                        <!-- Status Card -->
                        <div
                            class="bg-white border rounded-xl p-5 mb-5 shadow-sm
                            {{ $absence->substituteTeacher ? 'border-green-200' : 'border-yellow-200' }}">
                            <div class="flex items-center">
                                <div
                                    class="flex-shrink-0 w-10 h-10 {{ $absence->substituteTeacher ? 'bg-green-100' : 'bg-yellow-100' }} rounded-full flex items-center justify-center">
                                    <i
                                        class="fas {{ $absence->substituteTeacher ? 'fa-check-circle text-green-600' : 'fa-clock text-yellow-600' }}"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-600">Status</p>
                                    <p
                                        class="text-lg font-semibold {{ $absence->substituteTeacher ? 'text-green-700' : 'text-yellow-700' }}">
                                        {{ $absence->substituteTeacher ? 'Telah Digantikan' : 'Belum Digantikan' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Reason -->
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mb-5">
                            <p class="text-sm font-medium text-gray-600 mb-2">Alasan Ketidakhadiran</p>
                            @if ($absence->reason)
                                <span
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 text-sm font-medium rounded-lg">
                                    {{ ucfirst($absence->reason) }}
                                </span>
                            @else
                                <span class="text-gray-400 text-sm italic">Tidak disebutkan</span>
                            @endif
                        </div>

                        <!-- Notes -->
                        @if ($absence->note)
                            <div class="bg-gray-50 border border-gray-100 rounded-xl p-5">
                                <p class="text-sm font-medium text-gray-600 mb-2 flex items-center">
                                    <i class="fas fa-sticky-note text-gray-500 mr-2"></i>Catatan
                                </p>
                                <p class="text-gray-800 bg-white p-3 rounded-lg border border-gray-200 text-sm">
                                    {{ $absence->note }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                {{-- <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mt-6">
                    <div class="bg-gradient-to-r from-blue-50 to-blue-25 px-6 py-4 border-b border-blue-100">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-bolt text-blue-500 mr-3"></i>
                            Akses Cepat
                        </h2>
                    </div>
                    <div class="p-5">
                        <a href="{{ route('public.absences.index') }}"
                            class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold mb-3">
                            <i class="fas fa-list mr-2"></i>Lihat Semua Absensi
                        </a>
                        <button onclick="window.print()"
                            class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm font-semibold">
                            <i class="fas fa-print mr-2"></i>Cetak Detail
                        </button>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
