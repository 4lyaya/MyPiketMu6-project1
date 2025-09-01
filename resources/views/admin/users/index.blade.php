@extends('layouts.admin')

@section('title', 'Daftar User')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Daftar User</h1>
    </div>

    <div class="mb-4">
        <a href="{{ route('admin.users.create') }}"
            class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Tambah User
        </a>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr class="text-left">
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Role</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $loop->iteration + $users->firstItem() - 1 }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ ucfirst($user->role) }}</td>

                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                Edit
                            </a>

                            @if ($user->id === auth()->id())
                                <span class="px-3 py-1 bg-gray-300 text-gray-700 rounded">Sedang digunakan</span>
                            @else
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
