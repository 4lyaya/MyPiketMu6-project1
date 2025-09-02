@extends('layouts.teachers')

@section('title', 'Daftar Absensi')
@section('breadcrumb', 'Daftar Absensi')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Daftar Absensi</h1>
                <p class="text-gray-600 text-sm mt-1">Kelola data ketidakhadiran mengajar</p>
            </div>
            <a href="{{ route('guru.absences.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                <i class="fas fa-plus mr-2 text-sm"></i>Tambah Absensi
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-gray-600">
                            <th class="px-4 py-3 font-medium text-xs uppercase tracking-wider">No</th>
                            <th class="px-4 py-3 font-medium text-xs uppercase tracking-wider">Tanggal</th>
                            <th class="px-4 py-3 font-medium text-xs uppercase tracking-wider hidden sm:table-cell">Guru
                                Absen</th>
                            <th class="px-4 py-3 font-medium text-xs uppercase tracking-wider">Pengganti</th>
                            <th class="px-4 py-3 font-medium text-xs uppercase tracking-wider hidden md:table-cell">Kelas
                            </th>
                            <th class="px-4 py-3 font-medium text-xs uppercase tracking-wider">Jam</th>
                            <th class="px-4 py-3 font-medium text-xs uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($absences as $absence)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 text-gray-900 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-4 py-4 text-gray-900">
                                    <div class="font-medium">{{ $absence->replaced_at->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500 sm:hidden mt-1">
                                        {{ $absence->absentTeacher->name ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-900 hidden sm:table-cell">
                                    {{ $absence->absentTeacher->name ?? '-' }}
                                </td>
                                <td class="px-4 py-4 text-gray-900">
                                    <span class="{{ $absence->substituteTeacher ? 'text-green-600' : 'text-gray-400' }}">
                                        {{ $absence->substituteTeacher->name ?? 'Belum ada' }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-gray-900 hidden md:table-cell">
                                    {{ $absence->classroom->name ?? '-' }}
                                </td>
                                <td class="px-4 py-4">
                                    @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($absence->getSelectedPeriods() as $period)
                                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                                    {{ $period }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('guru.absences.show', $absence) }}"
                                            class="p-2 text-blue-600 hover:text-blue-800 transition-colors"
                                            title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('guru.absences.edit', $absence) }}"
                                            class="p-2 text-yellow-600 hover:text-yellow-800 transition-colors"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-clipboard-list text-3xl text-gray-300 mb-3"></i>
                                        <p class="text-sm font-medium text-gray-500 mb-1">Belum ada data absensi</p>
                                        <p class="text-xs text-gray-400">Mulai dengan menambahkan absensi baru</p>
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
            <div class="bg-white px-4 py-3 rounded-lg border border-gray-200">
                {{ $absences->links() }}
            </div>
        @endif
    </div>
@endsection
