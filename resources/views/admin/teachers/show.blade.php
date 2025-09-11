@extends('layouts.admin')

@section('title', 'Detail Guru')

@section('content')
    <div class="max-w-3xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Detail Guru</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Informasi lengkap data guru</p>
        </div>

        <!-- Detail Card -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-5 space-y-4">
                <!-- Nama -->
                <div class="flex items-start gap-4">
                    <div class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Nama Lengkap</div>
                    <div class="flex-1 text-sm text-gray-900 dark:text-gray-100 font-semibold">{{ $teacher->name }}</div>
                </div>

                <!-- Telepon -->
                <div class="flex items-start gap-4">
                    <div class="w-32 text-sm font-medium text-gray-500 dark:text-gray-400">Nomor Telepon</div>
                    <div class="flex-1 text-sm text-gray-900 dark:text-gray-100">{{ $teacher->phone ?? '-' }}</div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div
                class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.teachers.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ route('admin.teachers.edit', $teacher) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg bg-primary-600 text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection
