@extends('layouts.admin')

@section('title', 'Import Data')
@section('subtitle', 'Import data Guru dan Kelas')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('success'))
            <div class="mb-4 px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Import Guru -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Import Data Guru</h3>
            <form method="POST" action="{{ route('admin.import.teachers') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="file" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Pilih File
                        Excel</label>
                    <input type="file" id="file" name="file"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">Import Guru</button>
            </form>
        </div>

        <!-- Import Kelas -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Import Data Kelas</h3>
            <form method="POST" action="{{ route('admin.import.classrooms') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="file" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Pilih File
                        Excel</label>
                    <input type="file" id="file" name="file"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">Import
                    Kelas</button>
            </form>
        </div>
    </div>
@endsection
