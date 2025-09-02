@extends('layouts.public')

@section('title', 'Daftar Absensi Guru')
@section('breadcrumb', 'Daftar Absensi')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3">Daftar Absensi Guru</h1>
            <p class="text-gray-600 text-sm sm:text-base">Informasi ketidakhadiran dan penggantian jam mengajar</p>
        </div>

        <!-- Filter Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sm:p-6 mb-6">
            <form action="{{ route('public.absences.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                    <select name="month"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                    <select name="year"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Semua Tahun</option>
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Guru</label>
                    <select name="teacher"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="">Semua Guru</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ request('teacher') == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name ?? 'Unknown Teacher' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors text-sm font-medium flex items-center justify-center">
                        <i class="fas fa-filter mr-2"></i>Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 text-center">
                <div class="text-2xl font-bold text-blue-600 mb-1">{{ $totalAbsences }}</div>
                <div class="text-sm text-gray-600 font-medium">Total Absensi</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 text-center">
                <div class="text-2xl font-bold text-green-600 mb-1">{{ $totalSubstitutions }}</div>
                <div class="text-sm text-gray-600 font-medium">Penggantian</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 text-center">
                <div class="text-2xl font-bold text-indigo-600 mb-1">{{ $uniqueTeachers }}</div>
                <div class="text-sm text-gray-600 font-medium">Guru Terlibat</div>
            </div>
        </div>

        <!-- Absences Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-700 text-xs uppercase tracking-wider">
                                Tanggal</th>
                            <th
                                class="px-4 py-3 text-left font-medium text-gray-700 text-xs uppercase tracking-wider hidden sm:table-cell">
                                Guru Absen</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700 text-xs uppercase tracking-wider">
                                Pengganti</th>
                            <th
                                class="px-4 py-3 text-left font-medium text-gray-700 text-xs uppercase tracking-wider hidden md:table-cell">
                                Kelas</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700 text-xs uppercase tracking-wider">Jam
                            </th>
                            <th class="px-4 py-3 text-left font-medium text-gray-700 text-xs uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($absences as $absence)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900 text-sm">
                                        {{ $absence->replaced_at ? $absence->replaced_at->format('d/m/Y') : 'Tanggal tidak valid' }}
                                    </div>
                                    <div class="text-xs text-gray-500 sm:hidden mt-1">
                                        {{ $absence->absentTeacher->name ?? 'Guru tidak diketahui' }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 hidden sm:table-cell">
                                    <span
                                        class="text-sm text-gray-800">{{ $absence->absentTeacher->name ?? 'Guru tidak diketahui' }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        class="text-sm text-gray-800">{{ $absence->substituteTeacher->name ?? 'Tidak ada pengganti' }}</span>
                                </td>
                                <td class="px-4 py-3 hidden md:table-cell">
                                    <span
                                        class="text-sm text-gray-800">{{ $absence->classroom->name ?? 'Kelas tidak diketahui' }}</span>
                                </td>
                                <td class="px-4 py-3 align-top">
                                    @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($absence->getSelectedPeriods() as $period)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                                    {{ $period }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm italic">Tidak ada jam</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('public.absences.show', $absence) }}"
                                        class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 rounded-md hover:bg-blue-100 transition-colors text-xs font-medium">
                                        <i class="fas fa-eye mr-1 text-xs"></i>
                                        <span>Detail</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-4">
                                        <i class="fas fa-clipboard-list text-3xl text-gray-300 mb-3"></i>
                                        <p class="text-sm font-medium text-gray-500 mb-1">Tidak ada data absensi</p>
                                        <p class="text-xs text-gray-400">Coba gunakan filter yang berbeda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($absences->hasPages())
            <div class="bg-white px-4 py-3 rounded-lg shadow-sm border border-gray-200">
                {{ $absences->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        @endif

        <!-- Information -->
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400 mt-0.5"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        Data absensi diperbarui secara real-time. Untuk informasi lebih lanjut, hubungi administrasi
                        sekolah.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
