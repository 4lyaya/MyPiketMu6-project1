@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('subtitle', 'Ringkasan data hari ini')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">

        <!-- Info Login -->
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-2xl p-6 border border-indigo-100 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Selamat datang, {{ auth()->user()->name }}</h2>
                    <p class="text-sm text-gray-600 mt-1">Login sebagai <span
                            class="font-medium text-indigo-700">{{ ucfirst(auth()->user()->role) }}</span></p>
                </div>
                <div class="text-sm text-gray-500">{{ now()->format('l, d F Y') }}</div>
            </div>
        </div>

        <!-- 3 Terbaru -->
        @if ($latestAbsences->isNotEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Absensi Terbaru</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($latestAbsences as $a)
                        <div class="p-4 rounded-xl border border-gray-200 hover:shadow-md transition">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $a->absentTeacher->name ?? '-' }}</p>
                                    <p class="text-sm text-gray-600 mt-1">→ {{ $a->substituteTeacher->name ?? '-' }}</p>
                                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1 flex-wrap">
                                        <span>{{ $a->classroom->name ?? '-' }}</span>
                                        @foreach ($a->getSelectedPeriods() as $period)
                                            <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded text-[10px]">
                                                {{ $period }}
                                            </span>
                                        @endforeach
                                    </p>
                                </div>
                                <span
                                    class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded-md">{{ ucfirst($a->reason) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Stat Card -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            @php $cards = [['label' => 'Total Guru', 'value' => $stats['total_guru'], 'icon' => 'users', 'color' => 'blue'], ['label' => 'Guru Absen', 'value' => $stats['guru_absen'], 'icon' => 'user-times', 'color' => 'red'], ['label' => 'Guru Menggantikan', 'value' => $stats['guru_menggantikan'], 'icon' => 'hands-helping', 'color' => 'green'], ['label' => 'Total Kelas', 'value' => $stats['total_kelas'], 'icon' => 'school', 'color' => 'purple'], ['label' => 'Total User', 'value' => $stats['total_user'], 'icon' => 'user-friends', 'color' => 'indigo']]; @endphp
            @foreach ($cards as $c)
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex items-center justify-between hover:shadow-md transition">
                    <div>
                        <p class="text-sm text-gray-500">{{ $c['label'] }}</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $c['value'] }}</p>
                    </div>
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-{{ $c['color'] }}-100 to-{{ $c['color'] }}-200 flex items-center justify-center shadow-inner">
                        <i class="fas fa-{{ $c['icon'] }} text-{{ $c['color'] }}-600 text-xl"></i>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <form method="GET" class="flex flex-col md:flex-row md:items-end gap-4">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari guru..."
                    class="w-full md:w-1/4 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="date" name="date" value="{{ $filterDate }}"
                    class="w-full md:w-1/4 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                {{-- <select name="reason"
                    class="w-full md:w-1/4 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Semua Alasan --</option>
                    @foreach (['sakit', 'alpha', 'izin', 'terlambat', 'tugas_sekolah'] as $r)
                        <option value="{{ $r }}" {{ $filterReason === $r ? 'selected' : '' }}>
                            {{ ucfirst($r) }}</option>
                    @endforeach
                </select> --}}
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">Filter</button>
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-6 py-2 bg-gray-200 text-gray-800 rounded-full hover:bg-gray-300 transition">Reset</a>
                </div>
            </form>
        </div>

        <!-- Data Absensi -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Data Absensi <span
                        class="text-gray-500 font-normal">({{ $filterDate ? \Carbon\Carbon::parse($filterDate)->format('d/m/Y') : 'Hari Ini' }})</span>
                </h2>
            </div>

            @if ($absences->isNotEmpty())
                {{-- Desktop --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-700">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left">Tanggal</th>
                                <th class="px-6 py-3 text-left">Guru Absen</th>
                                <th class="px-6 py-3 text-left">Pengganti</th>
                                <th class="px-6 py-3 text-left">Kelas</th>
                                <th class="px-6 py-3 text-left">Jam</th>
                                <th class="px-6 py-3 text-left">Alasan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($absences as $a)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">{{ $a->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $a->absentTeacher->name ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $a->substituteTeacher->name ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $a->classroom->name ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($a->getSelectedPeriods() as $p)
                                                <span
                                                    class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-md">{{ $p }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-full">{{ ucfirst($a->reason) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile --}}
                <div class="md:hidden divide-y divide-gray-100">
                    @foreach ($absences as $a)
                        <div class="p-6 space-y-3 text-sm">
                            <div class="flex justify-between items-start">
                                <span class="font-semibold text-gray-900">{{ $a->created_at->format('d/m/Y') }}</span>
                                <span
                                    class="px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-full">{{ ucfirst($a->reason) }}</span>
                            </div>
                            <div class="grid grid-cols-1 gap-3 text-gray-600">
                                <div class="flex justify-between"><span class="text-gray-400">Guru Absen:</span><span
                                        class="font-medium">{{ $a->absentTeacher->name ?? '-' }}</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">Pengganti:</span><span
                                        class="font-medium">{{ $a->substituteTeacher->name ?? '-' }}</span></div>
                                <div class="flex justify-between"><span class="text-gray-400">Kelas:</span><span
                                        class="font-medium">{{ $a->classroom->name ?? '-' }}</span></div>
                                <div class="flex items-start gap-2">
                                    <span class="text-gray-400">Jam:</span>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($a->getSelectedPeriods() as $p)
                                            <span
                                                class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-md">{{ $p }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $absences->appends(request()->only(['search', 'date', 'reason']))->links('components.pagination') }}
                </div>
            @else
                <div class="text-center py-12 text-gray-400">
                    <i class="fas fa-inbox text-4xl mb-4"></i>
                    <p class="text-lg">Tidak ada data absensi</p>
                </div>
            @endif
        </div>

    </div>
@endsection
