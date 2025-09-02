@extends('layouts.admin')

@section('title', 'Daftar User')
@section('page-title', 'Manajemen User')

@section('breadcrumb')
    <li>
        <span class="text-gray-500">/</span>
        <span class="text-gray-700">Daftar User</span>
    </li>
@endsection

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <!-- Header dengan tombol tambah -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar User</h2>
                <p class="text-gray-600 mt-1">Kelola data user sistem</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-plus mr-2"></i>Tambah User
            </a>
        </div>

        <!-- Tabel user -->
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="w-full whitespace-nowrap">
                <thead class="bg-gray-50">
                    <tr class="text-left text-sm font-medium text-gray-700">
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        {{-- <th class="px-6 py-3">Status</th> --}}
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $counter = ($users->currentPage() - 1) * $users->perPage();
                    @endphp
                    @forelse ($users as $user)
                        @php
                            $counter++;
                            $isCurrentUser = $user->id === auth()->id();
                        @endphp
                        <tr
                            class="hover:bg-gray-50 transition-colors {{ $isCurrentUser ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $counter }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 {{ $isCurrentUser ? 'bg-blue-100' : 'bg-indigo-100' }} rounded-full flex items-center justify-center mr-3">
                                        <i
                                            class="fas fa-user {{ $isCurrentUser ? 'text-blue-600' : 'text-indigo-600' }} text-sm"></i>
                                    </div>
                                    {{ $user->name }}
                                    @if ($isCurrentUser)
                                        <span
                                            class="ml-2 text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Anda</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            {{-- <td class="px-6 py-4 text-sm">
                                @if ($isCurrentUser)
                                    <span
                                        class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                        <i class="fas fa-circle text-[8px] mr-1"></i>Online
                                    </span>
                                @else
                                    <span class="text-gray-500">-</span>
                                @endif
                            </td> --}}
                            <td class="px-6 py-4 text-sm text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-md hover:bg-indigo-200 transition-colors"
                                        title="Edit User">
                                        <i class="fas fa-edit text-xs mr-1"></i>Edit
                                    </a>

                                    @if ($isCurrentUser)
                                        <span
                                            class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-600 rounded-md"
                                            title="Tidak dapat menghapus akun sendiri">
                                            <i class="fas fa-ban text-xs mr-1"></i>Hapus
                                        </span>
                                    @else
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors"
                                                onclick="return confirm('Yakin ingin menghapus user {{ $user->name }}?')"
                                                title="Hapus User">
                                                <i class="fas fa-trash text-xs mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-users text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-lg">Tidak ada data user</p>
                                    <p class="text-sm mt-1">Mulai dengan menambahkan user baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@endsection
