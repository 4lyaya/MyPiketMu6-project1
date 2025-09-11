@extends('layouts.admin')

@section('title', 'Daftar Absensi')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Daftar Absensi</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola data absensi guru</p>
            </div>
            <a href="{{ route('admin.absences.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition">
                <i class="fas fa-plus"></i>
                Tambah Absensi
            </a>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div id="alert-success"
                class="flex items-center gap-3 p-4 mb-5 text-green-800 dark:text-green-200 rounded-xl bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button data-dismiss-target="#alert-success" aria-label="Close"
                    class="ml-auto -mx-1.5 -my-1.5 bg-green-50 dark:bg-green-900/30 text-green-500 dark:text-green-400 rounded-lg p-1.5 hover:bg-green-200 dark:hover:bg-green-800">
                    <i class="fas fa-times w-4 h-4"></i>
                </button>
            </div>
        @endif

        <!-- Desktop: Table Card -->
        <div
            class="hidden md:block bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-900/50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Tanggal Dibuat</th>
                            <th
                                class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Guru Absen</th>
                            <th
                                class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Guru Pengganti</th>
                            <th
                                class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Kelas</th>
                            <th
                                class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Jam</th>
                            <th
                                class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Alasan</th>
                            <th
                                class="px-6 py-3 text-center font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($absences as $absence)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                    {{ ($absences->currentPage() - 1) * $absences->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                    {{ $absence->replaced_at ? \Carbon\Carbon::parse($absence->created_at)->format('d M Y') : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                    {{ $absence->absentTeacher->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                    {{ $absence->substituteTeacher->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                    {{ $absence->classroom->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                    @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($absence->getSelectedPeriods() as $period)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-md">
                                                    {{ $period }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-gray-900 dark:text-gray-100 max-w-xs truncate"
                                    title="{{ $absence->reason }}">
                                    {{ $absence->reason ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.absences.show', $absence) }}"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-900/50">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('admin.absences.edit', $absence) }}"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 hover:bg-amber-100 dark:hover:bg-amber-900/50">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.absences.destroy', $absence) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus absensi ini?');" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/50">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-clipboard-list text-4xl mb-3 text-gray-300 dark:text-gray-600"></i>
                                    <p>Belum ada data absensi.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($absences->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $absences->links('components.pagination') }}
                </div>
            @endif
        </div>

        <!-- Mobile: Card List -->
        <div class="md:hidden space-y-4">
            @forelse($absences as $absence)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                {{ $absence->absentTeacher->name ?? '-' }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $absence->replaced_at ? \Carbon\Carbon::parse($absence->replaced_at)->translatedFormat('d F Y') : '-' }}
                            </p>
                        </div>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            {{ $absence->classroom->name ?? '-' }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-xs text-gray-600 dark:text-gray-400 mb-3">
                        <div>
                            <span class="text-gray-400 dark:text-gray-500">Pengganti:</span>
                            <p class="font-medium text-gray-800 dark:text-gray-200">
                                {{ $absence->substituteTeacher->name ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-400 dark:text-gray-500">Alasan:</span>
                            <p class="font-medium text-gray-800 dark:text-gray-200">{{ $absence->reason ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-1 mb-3">
                        @if ($absence->periods_mask && method_exists($absence, 'getSelectedPeriods'))
                            @foreach ($absence->getSelectedPeriods() as $period)
                                <span
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-md">
                                    {{ $period }}
                                </span>
                            @endforeach
                        @else
                            <span class="text-xs text-gray-400 dark:text-gray-500">-</span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.absences.show', $absence) }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-900/50">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.absences.edit', $absence) }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 hover:bg-amber-100 dark:hover:bg-amber-900/50">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.absences.destroy', $absence) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus absensi ini?');" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/50">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8 text-center text-gray-500 dark:text-gray-400">
                    <i class="fas fa-clipboard-list text-4xl mb-3 text-gray-300 dark:text-gray-600"></i>
                    <p>Belum ada data absensi.</p>
                </div>
            @endforelse

            @if ($absences->hasPages())
                <div class="mt-6">
                    {{ $absences->links('components.pagination') }}
                </div>
            @endif
        </div>

    </div>
@endsection
