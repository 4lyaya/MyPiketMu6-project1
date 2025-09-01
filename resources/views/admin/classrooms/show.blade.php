@extends('layouts.admin')

@section('title', 'Detail Kelas')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Kelas</h1>

    <div class="bg-white p-6 rounded shadow space-y-4">
        <p><strong>Nama Kelas:</strong> {{ $classroom->name }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.classrooms.index') }}" class="px-4 py-2 bg-gray-300 rounded">Kembali</a>
        <a href="{{ route('admin.classrooms.edit', $classroom) }}"
            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
    </div>
@endsection
