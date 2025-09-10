@extends('layouts.admin')

@section('title', 'Backup Data')
@section('subtitle', 'Unduh seluruh data aplikasi')

@php
    use App\Models\Teacher;
    use App\Models\Classroom;
    use App\Models\Absence;

    $teachers = Teacher::with('user')->latest()->get();
    $classrooms = Classroom::latest()->get();
    $absences = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])
        ->latest()
        ->get();
@endphp

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

        <!-- Header -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Backup Data</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Unduh data guru, kelas, dan absensi dalam format Excel atau
                PDF.</p>
        </div>

        <!-- Tombol Full Backup -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <form action="{{ route('admin.backup.full', ['type' => 'excel']) }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="px-6 py-3 bg-green-600 text-white rounded-full hover:bg-green-700 transition shadow flex items-center gap-2">
                    <i class="fas fa-file-excel"></i>
                    <span>Download Full Excel</span>
                </button>
            </form>
            <form action="{{ route('admin.backup.full', ['type' => 'pdf']) }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="px-6 py-3 bg-red-600 text-white rounded-full hover:bg-red-700 transition shadow flex items-center gap-2">
                    <i class="fas fa-file-pdf"></i>
                    <span>Download Full PDF</span>
                </button>
            </form>
        </div>

        <!-- Preview Guru -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Data Guru</h2>
                <form action="{{ route('admin.backup.partial', ['table' => 'teachers', 'type' => 'excel']) }}"
                    method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm flex items-center gap-2">
                        <i class="fas fa-download"></i> Excel
                    </button>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Telepon
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($teachers as $g)
                            <tr>
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 font-medium">{{ $g->name }}</td>
                                <td class="px-4 py-2">{{ $g->phone ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Tidak ada
                                    data guru.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Preview Kelas -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Data Kelas</h2>
                <form action="{{ route('admin.backup.partial', ['table' => 'classrooms', 'type' => 'excel']) }}"
                    method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm flex items-center gap-2">
                        <i class="fas fa-download"></i> Excel
                    </button>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Nama Kelas
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($classrooms as $c)
                            <tr>
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 font-medium">{{ $c->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Tidak ada
                                    data kelas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Preview Absensi -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Data Absensi</h2>
                <form action="{{ route('admin.backup.partial', ['table' => 'absences', 'type' => 'excel']) }}"
                    method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm flex items-center gap-2">
                        <i class="fas fa-download"></i> Excel
                    </button>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">No</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Guru Absen
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Pengganti
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Kelas</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Tanggal
                            </th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Jam</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Alasan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($absences as $a)
                            <tr>
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $a->absentTeacher->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $a->substituteTeacher->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ $a->classroom->name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($a->replaced_at)->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($a->getSelectedPeriods() as $p)
                                            <span
                                                class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400 rounded text-[10px]">
                                                {{ $p }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <span
                                        class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-[10px]">
                                        {{ ucfirst($a->reason) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">Tidak ada
                                    data absensi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
