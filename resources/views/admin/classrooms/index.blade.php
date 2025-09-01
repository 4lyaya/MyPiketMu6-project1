@extends('layouts.admin')

@section('title', 'Daftar Kelas')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Kelas</h1>
        <a href="{{ route('admin.classrooms.create') }}"
            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Tambah Kelas
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
                    <th class="px-4 py-2">Nama Kelas</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classrooms as $classroom)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $classroom->name }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('admin.classrooms.show', $classroom) }}"
                                class="text-blue-600 hover:underline">Lihat</a>
                            <a href="{{ route('admin.classrooms.edit', $classroom) }}"
                                class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.classrooms.destroy', $classroom) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-3 text-center text-gray-500">Belum ada data kelas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $classrooms->links() }}
    </div>
@endsection
