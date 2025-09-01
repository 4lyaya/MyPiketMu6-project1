@extends('layouts.teachers')

@section('title', 'Dashboard Guru')

@section('content')
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Guru</h1>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-700">Total Ketidakhadiran</h2>
                <p class="text-3xl font-bold text-red-500 mt-2">
                    {{ $stats['total_absences'] ?? 0 }}
                </p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-700">Total Menggantikan</h2>
                <p class="text-3xl font-bold text-green-500 mt-2">
                    {{ $stats['total_substitutions'] ?? 0 }}
                </p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-700">Kelas yang Diampu</h2>
                <p class="text-3xl font-bold text-blue-500 mt-2">
                    {{ $stats['total_classes'] ?? 0 }}
                </p>
            </div>
        </div>

        <!-- Catatan -->
        <div class="mt-10 bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Catatan Terbaru</h2>
            @if (!empty($stats['latest_notes']))
                <ul class="list-disc pl-6 space-y-2">
                    @foreach ($stats['latest_notes'] as $note)
                        <li class="text-gray-700">{{ $note }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Belum ada catatan terbaru.</p>
            @endif
        </div>
    </div>
@endsection
