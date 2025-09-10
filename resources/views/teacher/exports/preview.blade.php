@extends('layouts.teachers')

@section('title', 'Preview Absensi')
@section('subtitle', 'Hasil ekspor')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Laporan Absensi</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        {{ optional($start)->format('d/m/Y') ?? 'Semua Tanggal' }} -
                        {{ optional($end)->format('d/m/Y') ?? 'Semua Tanggal' }}
                    </p>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-wrap gap-3">
                    <a href="{{ url()->previous() }}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                    <!-- Preview HTML (aktif jika sedang tidak melihat HTML) -->
                    @if (request('output') !== 'html')
                        <form action="{{ route('guru.exports.export') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="teacher_id" value="{{ $teacher ? $teacher->id : '' }}">
                            <input type="hidden" name="start_date" value="{{ $start ? $start->format('Y-m-d') : '' }}">
                            <input type="hidden" name="end_date" value="{{ $end ? $end->format('Y-m-d') : '' }}">
                            <input type="hidden" name="output" value="html">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition flex items-center gap-2">
                                <i class="fas fa-eye"></i> Preview HTML
                            </button>
                        </form>
                    @endif

                    <!-- Unduh PDF -->
                    <form action="{{ route('guru.exports.export') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="teacher_id" value="{{ $teacher ? $teacher->id : '' }}">
                        <input type="hidden" name="start_date" value="{{ $start ? $start->format('Y-m-d') : '' }}">
                        <input type="hidden" name="end_date" value="{{ $end ? $end->format('Y-m-d') : '' }}">
                        <input type="hidden" name="output" value="pdf">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition flex items-center gap-2">
                            <i class="fas fa-file-pdf"></i> Unduh PDF
                        </button>
                    </form>

                    <!-- Unduh Excel -->
                    <form action="{{ route('guru.exports.export') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="teacher_id" value="{{ $teacher ? $teacher->id : '' }}">
                        <input type="hidden" name="start_date" value="{{ $start ? $start->format('Y-m-d') : '' }}">
                        <input type="hidden" name="end_date" value="{{ $end ? $end->format('Y-m-d') : '' }}">
                        <input type="hidden" name="output" value="xlsx">
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition flex items-center gap-2">
                            <i class="fas fa-file-excel"></i> Unduh Excel
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Desktop: Tabel -->
        <div
            class="hidden md:block bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Tanggal Diganti</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Guru Absen</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Pengganti</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Kelas</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Jam Pelajaran</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Alasan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($absences as $a)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($a->replaced_at)->translatedFormat('d F Y') }}</td>
                                <td class="px-6 py-4">{{ $a->absentTeacher->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $a->substituteTeacher->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $a->classroom->name ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($a->getSelectedPeriods() as $p)
                                            <span
                                                class="px-2 py-1 text-xs bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 rounded-full">{{ $p }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 text-xs bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-full">{{ ucfirst($a->reason) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile: Card -->
        <div class="md:hidden space-y-4">
            @foreach ($absences as $a)
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-3 text-sm">
                    <div class="flex justify-between items-start">
                        <span
                            class="font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($a->replaced_at)->translatedFormat('d F Y') }}</span>
                        <span
                            class="px-3 py-1 text-xs bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-full">{{ ucfirst($a->reason) }}</span>
                    </div>
                    <div class="grid grid-cols-1 gap-3 text-gray-600 dark:text-gray-400">
                        <div class="flex justify-between"><span class="text-gray-400 dark:text-gray-500">Guru
                                Absen:</span><span
                                class="font-medium text-gray-900 dark:text-white">{{ $a->absentTeacher->name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between"><span
                                class="text-gray-400 dark:text-gray-500">Pengganti:</span><span
                                class="font-medium text-gray-900 dark:text-white">{{ $a->substituteTeacher->name ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between"><span class="text-gray-400 dark:text-gray-500">Kelas:</span><span
                                class="font-medium text-gray-900 dark:text-white">{{ $a->classroom->name ?? '-' }}</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="text-gray-400 dark:text-gray-500">Jam:</span>
                            <div class="flex flex-wrap gap-1">
                                @foreach ($a->getSelectedPeriods() as $p)
                                    <span
                                        class="px-2 py-1 text-xs bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 rounded-full">{{ $p }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
