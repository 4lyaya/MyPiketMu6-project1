@extends('layouts.admin')

@section('title', 'Edit Kelas')

@section('content')
    <div class="max-w-2xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit Kelas</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi kelas</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('admin.classrooms.update', $classroom) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Nama Kelas -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Kelas</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $classroom->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror"
                        placeholder="Contoh: X IPA 1" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <a href="{{ route('admin.classrooms.index') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <i class="fas fa-arrow-left"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg bg-primary-600 text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition">
                        <i class="fas fa-save"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
