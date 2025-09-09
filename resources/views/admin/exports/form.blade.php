@extends('layouts.admin')
@section('title', 'Ekspor Absensi')
@section('subtitle', 'Pilih guru & rentang tanggal')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 md:p-8">
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Filter Ekspor</h3>
                <p class="text-sm text-gray-500 mt-1">Pilih guru & rentang tanggal untuk mengekspor data absensi.</p>
            </div>

            <form method="POST" action="{{ route('admin.exports.export') }}" class="space-y-6">
                @csrf

                <!-- Grid Responsive -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <!-- Guru -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Guru (opsional)</label>
                        <select name="teacher_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Semua Guru --</option>
                            @foreach ($teachers as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai (opsional)</label>
                        <input type="date" name="start_date"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Tanggal Akhir -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir (opsional)</label>
                        <input type="date" name="end_date"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Output -->
                    <div class="lg:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Output</label>
                        <select name="output" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="html">Preview HTML</option>
                            <option value="pdf">Unduh PDF</option>
                        </select>
                    </div>

                </div>

                <!-- Info & Tombol -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <p class="text-xs text-gray-500">Kosongkan guru atau tanggal untuk menampilkan data hari ini.</p>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2">
                        <i class="fas fa-file-export"></i>
                        <span>Ekspor Data</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
