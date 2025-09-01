@extends('layouts.teachers')

@section('title', 'Daftar Absensi')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Absensi</h1>
        <a href="{{ route('guru.absences.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Tambah Absensi
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Guru Absen</th>
                    <th class="px-4 py-2">Pengganti</th>
                    <th class="px-4 py-2">Kelas</th>
                    <th class="px-4 py-2">Jam</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absences as $absence)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-4 py-2">
                            {{ \Carbon\Carbon::parse($absence->replaced_at)->format('d-m-Y') }}
                        </td>
                        <td class="px-4 py-2">{{ $absence->absentTeacher->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absence->substituteTeacher->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $absence->classroom->name ?? '-' }}</td>
                        <td class="px-4 py-2">
                            {{ $absence->periods_mask ? 'Jam ' . implode(', ', $absence->getSelectedPeriods()) : '-' }}
                        </td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('guru.absences.show', $absence) }}"
                                class="text-blue-600 hover:underline">Lihat</a>
                            <a href="{{ route('guru.absences.edit', $absence) }}"
                                class="text-yellow-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-500">
                            Belum ada data absensi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $absences->links() }}
    </div>
@endsection
