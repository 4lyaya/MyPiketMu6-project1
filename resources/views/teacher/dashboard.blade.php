@extends('layouts.teachers')
@section('title', 'Dashboard Guru')
@section('subtitle', 'Ringkasan aktivitas mengajar Anda')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">

        <!-- Header -->
        <div class="bg-gradient-to-br from-primary-600 to-primary-700 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-graduate text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}</h1>
                        <p class="text-primary-100 text-sm mt-1">Semangat mengajar hari ini!</p>
                    </div>
                </div>
                <div class="bg-white/10 rounded-xl px-4 py-3 text-right">
                    <p class="text-primary-100 text-xs">Hari ini</p>
                    <p class="text-white font-semibold">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Total Absensi</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalAbsences }}</p>
                    </div>
                    <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-user-times text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Total Substitusi</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalSubstitutions }}</p>
                    </div>
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-hands-helping text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium mb-1">Guru Unik</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $uniqueTeachers }}</p>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Absensi -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Absensi Terbaru</h2>

            @if ($absences->isNotEmpty())
                {{-- Desktop: tabel --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">No</th>
                                <th class="px-4 py-3 text-left">Tanggal</th>
                                <th class="px-4 py-3 text-left">Guru Absen</th>
                                <th class="px-4 py-3 text-left">Pengganti</th>
                                <th class="px-4 py-3 text-left">Kelas</th>
                                <th class="px-4 py-3 text-left">Jam</th>
                                <th class="px-4 py-3 text-left">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($absences as $a)
                                <tr>
                                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-3">{{ $a->created_at->format('d/m/Y') }}</td>
                                    <td class="px-4 py-3">{{ $a->absentTeacher->name ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $a->substituteTeacher->name ?? '-' }}</td>
                                    <td class="px-4 py-3">{{ $a->classroom->name ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        @if ($a->periods_mask && method_exists($a, 'getSelectedPeriods'))
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($a->getSelectedPeriods() as $period)
                                                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-md">
                                                        {{ $period }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($a->reason)
                                            <span class="px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-md">
                                                {{ $a->reason }}
                                            </span>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile: card --}}
                <div class="md:hidden space-y-4">
                    @foreach ($absences as $a)
                        <div class="bg-gray-50 rounded-xl border border-gray-200 p-4 space-y-2 text-sm">
                            <div class="flex justify-between items-start">
                                <span class="font-semibold text-gray-700">#{{ $loop->iteration }}</span>
                                <span class="text-gray-600">{{ $a->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Guru Absen:</span>
                                <span class="ml-2 font-medium text-gray-800">{{ $a->absentTeacher->name ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Pengganti:</span>
                                <span
                                    class="ml-2 font-medium text-gray-800">{{ $a->substituteTeacher->name ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Kelas:</span>
                                <span class="ml-2 font-medium text-gray-800">{{ $a->classroom->name ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Jam:</span>
                                <span class="ml-2">
                                    @if ($a->periods_mask && method_exists($a, 'getSelectedPeriods'))
                                        <div class="inline-flex flex-wrap gap-1 mt-1">
                                            @foreach ($a->getSelectedPeriods() as $period)
                                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-md">
                                                    {{ $period }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-500">Keterangan:</span>
                                <span class="ml-2">
                                    @if ($a->reason)
                                        <span class="px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-md">
                                            {{ $a->reason }}
                                        </span>
                                    @else
                                        <span class="text-gray-500">-</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-calendar-check text-3xl mb-3"></i>
                    <p class="text-sm">Belum ada data absensi</p>
                </div>
            @endif
        </div>
    </div>
@endsection
