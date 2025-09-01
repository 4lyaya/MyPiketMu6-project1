@extends('layouts.teachers')

@section('title', 'Detail Absensi')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Absensi</h1>

    <div class="bg-white p-6 rounded shadow space-y-4">
        <p><strong>Tanggal:</strong> {{ $absence->replaced_at->format('d-m-Y') }}</p>
        <p><strong>Guru Absen:</strong> {{ $absence->absentTeacher->name ?? '-' }}</p>
        <p><strong>Guru Pengganti:</strong> {{ $absence->substituteTeacher->name ?? '-' }}</p>
        <p><strong>Kelas:</strong> {{ $absence->classroom->name ?? '-' }}</p>
        <p><strong>Jam Pelajaran:</strong>
            {{ $absence->periods_mask ? 'Jam ' . implode(', ', \App\Helpers\PeriodHelper::maskToPeriods($absence->periods_mask)) : '-' }}
        </p>
        <p><strong>Alasan:</strong> {{ $absence->reason ?? '-' }}</p>
        <p><strong>Catatan:</strong> {{ $absence->note ?? '-' }}</p>
    </div>

    <div class="mt-6 flex space-x-3">
        <a href="{{ route('guru.absences.index') }}" class="px-4 py-2 bg-gray-300 rounded">Kembali</a>
        <a href="{{ route('guru.absences.edit', $absence) }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
    </div>
@endsection
