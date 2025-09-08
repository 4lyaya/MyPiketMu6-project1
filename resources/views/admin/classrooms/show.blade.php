@extends('layouts.admin')

@section('title', 'Detail Kelas')

@section('content')
    <div class="max-w-3xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Detail Kelas</h1>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap data kelas</p>
        </div>

        <!-- Detail Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-5">
                <!-- Nama Kelas -->
                <div class="flex items-start gap-4">
                    <div class="w-32 text-sm font-medium text-gray-500">Nama Kelas</div>
                    <div class="flex-1 text-sm text-gray-900 font-semibold">{{ $classroom->name }}</div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.classrooms.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ route('admin.classrooms.edit', $classroom) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg bg-primary-600 text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>
@endsection
