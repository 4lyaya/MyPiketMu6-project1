@extends('layouts.admin')

@section('title', 'Daftar Guru')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Guru</h1>
        <a href="{{ route('admin.teachers.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Tambah Guru
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Telepon</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $teacher->name }}</td>
                        <td class="px-4 py-2">{{ $teacher->phone ?? '-' }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('admin.teachers.show', $teacher) }}"
                                class="text-blue-600 hover:underline">Lihat</a>
                            <a href="{{ route('admin.teachers.edit', $teacher) }}"
                                class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-3 text-center text-gray-500">Belum ada data guru.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $teachers->links() }}
    </div>
@endsection
