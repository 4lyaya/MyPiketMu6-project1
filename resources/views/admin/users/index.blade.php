@extends('layouts.admin')

@section('title', 'Daftar User')
@section('page-title', 'Manajemen User')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Daftar User</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data user sistem</p>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition">
                <i class="fas fa-plus"></i>
                Tambah User
            </a>
        </div>

        <!-- Desktop: Table Card -->
        <div class="hidden md:block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-center font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($users as $user)
                            @php $isCurrentUser = $user->id === auth()->id(); @endphp
                            <tr
                                class="hover:bg-gray-50 transition {{ $isCurrentUser ? 'bg-blue-50 border-l-4 border-blue-500' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-9 h-9 rounded-full {{ $isCurrentUser ? 'bg-blue-100' : 'bg-primary-100' }} flex items-center justify-center">
                                            <i
                                                class="fas fa-user {{ $isCurrentUser ? 'text-blue-600' : 'text-primary-600' }}"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                            @if ($isCurrentUser)
                                                <span
                                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full">Anda</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-amber-50 text-amber-700 hover:bg-amber-100">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        @if ($isCurrentUser)
                                            <span
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-gray-100 text-gray-600 cursor-not-allowed">
                                                <i class="fas fa-ban"></i> Hapus
                                            </span>
                                        @else
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}?');"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-red-50 text-red-700 hover:bg-red-100">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                    <i class="fas fa-users text-4xl mb-3 text-gray-300"></i>
                                    <p>Belum ada data user.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $users->links('components.pagination') }}
                </div>
            @endif
        </div>

        <!-- Mobile: Card List -->
        <div class="md:hidden space-y-4">
            @forelse ($users as $user)
                @php $isCurrentUser = $user->id === auth()->id(); @endphp
                <div
                    class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 {{ $isCurrentUser ? 'border-l-4 border-blue-500' : '' }}">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full {{ $isCurrentUser ? 'bg-blue-100' : 'bg-primary-100' }} flex items-center justify-center">
                                <i class="fas fa-user {{ $isCurrentUser ? 'text-blue-600' : 'text-primary-600' }}"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                @if ($isCurrentUser)
                                    <span class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full">Anda</span>
                                @endif
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                        {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>

                    <div class="mt-4 flex items-center gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-amber-50 text-amber-700 hover:bg-amber-100">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        @if ($isCurrentUser)
                            <span
                                class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-gray-100 text-gray-600 cursor-not-allowed">
                                <i class="fas fa-ban"></i> Hapus
                            </span>
                        @else
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}?');"
                                class="flex-1">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-red-50 text-red-700 hover:bg-red-100">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center text-gray-500">
                    <i class="fas fa-users text-4xl mb-3 text-gray-300"></i>
                    <p>Belum ada data user.</p>
                </div>
            @endforelse

            @if ($users->hasPages())
                <div class="mt-6">
                    {{ $users->links('components.pagination') }}
                </div>
            @endif
        </div>
    </div>
@endsection
