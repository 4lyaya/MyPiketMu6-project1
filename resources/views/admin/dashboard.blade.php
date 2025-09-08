@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Admin</h1>
            <p class="mt-2 text-sm text-gray-600">Ringkasan data dan aktivitas terbaru</p>
        </div>

        <!-- Statistik Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Total Guru -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-700">Total Guru</p>
                        <p class="mt-2 text-4xl font-extrabold text-blue-900">{{ $stats['total_teachers'] ?? 0 }}</p>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-200">
                        <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.184-1.268-.5-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.184-1.268.5-1.857m0 0a5.002 5.002 0 019 0m-4.5 0a5.002 5.002 0 00-9 0m9 0V4a2 2 0 10-4 0v12a2 2 0 104 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Absensi -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-50 to-red-100 p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-red-700">Total Absensi</p>
                        <p class="mt-2 text-4xl font-extrabold text-red-900">{{ $stats['total_absences'] ?? 0 }}</p>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-red-200">
                        <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Substitusi -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-50 to-green-100 p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-700">Total Substitusi</p>
                        <p class="mt-2 text-4xl font-extrabold text-green-900">{{ $stats['total_substitutions'] ?? 0 }}</p>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-green-200">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Kelas -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-purple-700">Total Kelas</p>
                        <p class="mt-2 text-4xl font-extrabold text-purple-900">{{ $stats['total_classes'] ?? 0 }}</p>
                    </div>
                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-purple-200">
                        <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Catatan Terbaru -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Catatan Terbaru</h2>
                <p class="text-xs text-gray-500 mt-1">Aktivitas terakhir yang perlu Anda ketahui</p>
            </div>
            <div class="p-6">
                @if (!empty($stats['latest_notes']))
                    <ul class="space-y-3">
                        @foreach ($stats['latest_notes'] as $note)
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-2 h-2 mt-1.5 rounded-full bg-indigo-500"></span>
                                <p class="ml-3 text-sm text-gray-700">{{ $note }}</p>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-10">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Belum ada catatan terbaru.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
