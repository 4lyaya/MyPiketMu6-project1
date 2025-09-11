@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('subtitle', 'Ringkasan data hari ini')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">

        <!-- Info Login -->
        <div
            class="bg-gradient-to-r from-blue-50 to-blue-50 dark:from-blue-900/20 dark:to-blue-900/20 rounded-2xl p-6 border border-blue-100 dark:border-blue-800 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Selamat datang,
                        {{ auth()->user()->name }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Login sebagai <span
                            class="font-medium text-blue-700 dark:text-blue-400">{{ ucfirst(auth()->user()->role) }}</span>
                    </p>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400">{{ now()->format('l, d F Y') }}</div>
            </div>
        </div>

        <!-- 3 Terbaru -->
        @if ($latestAbsences->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Absensi Terbaru</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($latestAbsences as $a)
                        <div class="p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">
                                        {{ $a->absentTeacher->name ?? '-' }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">→
                                        {{ $a->substituteTeacher->name ?? '-' }}</p>
                                    <p
                                        class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center gap-1 flex-wrap">
                                        <span>{{ $a->classroom->name ?? '-' }}</span>
                                        @foreach ($a->getSelectedPeriods() as $period)
                                            <span
                                                class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400 rounded text-[10px]">
                                                {{ $period }}
                                            </span>
                                        @endforeach
                                    </p>
                                </div>
                                <span
                                    class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md">{{ ucfirst($a->reason) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Stat Card -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            @php
                $cards = [
                    ['label' => 'Total Guru', 'value' => $stats['total_guru'], 'icon' => 'users', 'color' => 'blue'],
                    [
                        'label' => 'Guru Absen',
                        'value' => $stats['guru_absen'],
                        'icon' => 'user-times',
                        'color' => 'red',
                    ],
                    [
                        'label' => 'Guru Menggantikan',
                        'value' => $stats['guru_menggantikan'],
                        'icon' => 'hands-helping',
                        'color' => 'green',
                    ],
                    [
                        'label' => 'Total Kelas',
                        'value' => $stats['total_kelas'],
                        'icon' => 'school',
                        'color' => 'purple',
                    ],
                    [
                        'label' => 'Total User',
                        'value' => $stats['total_user'],
                        'icon' => 'user-friends',
                        'color' => 'indigo',
                    ],
                ];
            @endphp
            @foreach ($cards as $c)
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $c['label'] }}</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $c['value'] }}</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-{{ $c['color'] }}-100 to-{{ $c['color'] }}-200 dark:from-{{ $c['color'] }}-900/30 dark:to-{{ $c['color'] }}-800/20 flex items-center justify-center shadow-inner">
                        <i
                            class="fas fa-{{ $c['icon'] }} text-{{ $c['color'] }}-600 dark:text-{{ $c['color'] }}-400 text-xl"></i>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Filter -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form method="GET" class="flex flex-col md:flex-row md:items-end gap-4">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari guru..."
                    class="w-full md:w-1/4 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-full bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="date" name="date" value="{{ $filterDate }}"
                    class="w-full md:w-1/4 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-full bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">Filter</button>
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-300 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600 transition">Reset</a>
                </div>
            </form>
        </div>

        <!-- Data Absensi -->
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Data Absensi <span
                        class="text-gray-500 dark:text-gray-400 font-normal">({{ $filterDate ? \Carbon\Carbon::parse($filterDate)->format('d/m/Y') : 'Hari Ini' }})</span>
                </h2>
            </div>

            @if ($absences->isNotEmpty())
                {{-- Desktop --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-700 dark:text-gray-300">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Tanggal</th>
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
                                    Jam</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Alasan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach ($absences as $a)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <td class="px-6 py-4">{{ $a->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $a->absentTeacher->name ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $a->substituteTeacher->name ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $a->classroom->name ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($a->getSelectedPeriods() as $p)
                                                <span
                                                    class="px-2 py-1 text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400 rounded-md">{{ $p }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full">{{ ucfirst($a->reason) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile --}}
                <div class="md:hidden divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($absences as $a)
                        <div class="p-6 space-y-3 text-sm text-gray-700 dark:text-gray-300">
                            <div class="flex justify-between items-start">
                                <span
                                    class="font-semibold text-gray-900 dark:text-white">{{ $a->created_at->format('d/m/Y') }}</span>
                                <span
                                    class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full">{{ ucfirst($a->reason) }}</span>
                            </div>
                            <div class="grid grid-cols-1 gap-3 text-gray-600 dark:text-gray-400">
                                <div class="flex justify-between">
                                    <span class="text-gray-400 dark:text-gray-500">Guru Absen:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $a->absentTeacher->name ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400 dark:text-gray-500">Pengganti:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $a->substituteTeacher->name ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400 dark:text-gray-500">Kelas:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $a->classroom->name ?? '-' }}</span>
                                </div>
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-400 dark:text-gray-500">Jam:</span>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($a->getSelectedPeriods() as $p)
                                            <span
                                                class="px-2 py-1 text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400 rounded-md">{{ $p }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $absences->appends(request()->only(['search', 'date', 'reason']))->links('components.pagination') }}
                </div>
            @else
                <div class="text-center py-12 text-gray-400 dark:text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-4"></i>
                    <p class="text-lg">Tidak ada data absensi</p>
                </div>
            @endif
        </div>
    </div>
@endsection
