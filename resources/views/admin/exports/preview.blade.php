@extends('layouts.admin')
@section('title', 'Preview Absensi')
@section('subtitle', 'Hasil ekspor')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Header Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Laporan Absensi</h2>
                    <p class="text-sm text-gray-600 mt-1">
                        {{ optional($start)->format('d/m/Y') ?? 'Semua Tanggal' }} -
                        {{ optional($end)->format('d/m/Y') ?? 'Semua Tanggal' }}
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ url()->previous() }}"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-full hover:bg-gray-300 transition flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <form action="{{ route('admin.exports.export') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="teacher_id" value="{{ $teacher ? $teacher->id : '' }}">
                        <input type="hidden" name="start_date" value="{{ $start ? $start->format('Y-m-d') : '' }}">
                        <input type="hidden" name="end_date" value="{{ $end ? $end->format('Y-m-d') : '' }}">
                        <input type="hidden" name="output" value="pdf">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition flex items-center gap-2">
                            <i class="fas fa-download"></i> Unduh PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-700">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Diganti</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guru
                                Absen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pengganti</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Pelajaran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Alasan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($absences as $a)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $a->replaced_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ $a->absentTeacher->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $a->substituteTeacher->name ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $a->classroom->name ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($a->getSelectedPeriods() as $p)
                                            <span
                                                class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">{{ $p }}</span>
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
        </div>
    </div>
@endsection
