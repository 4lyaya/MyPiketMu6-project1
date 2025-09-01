@extends('layouts.admin')

@section('title', 'Tambah Kelas')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Tambah Kelas</h1>

    <form action="{{ route('admin.classrooms.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block mb-1">Nama Kelas</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-3 py-2 rounded">
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.classrooms.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Simpan</button>
        </div>
    </form>
@endsection
