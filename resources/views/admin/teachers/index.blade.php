@extends('layouts.admin')

@section('title', 'Daftar Guru')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Daftar Guru</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola informasi seluruh guru</p>
            </div>
            <a href="{{ route('admin.teachers.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition">
                <i class="fas fa-plus"></i>
                Tambah Guru
            </a>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div id="alert-success"
                class="flex items-center gap-3 p-4 mb-5 text-green-800 rounded-xl bg-green-50 border border-green-200 dark:bg-green-900/30 dark:border-green-700">
                <i class="fas fa-check-circle text-green-600"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button data-dismiss-target="#alert-success" aria-label="Close"
                    class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200">
                    <i class="fas fa-times w-4 h-4"></i>
                </button>
            </div>
        @endif

        <!-- Desktop: Table Card -->
        <div
            class="hidden md:block bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                No</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Nama</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Telepon</th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($teachers as $teacher)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                    {{ ($teachers->currentPage() - 1) * $teachers->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white font-medium">
                                    {{ $teacher->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-400">
                                    {{ $teacher->phone ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.teachers.show', $teacher) }}"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-800">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('admin.teachers.edit', $teacher) }}"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 hover:bg-amber-100 dark:hover:bg-amber-800">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus guru ini?');" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-800">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-user-slash text-4xl mb-3 text-gray-300 dark:text-gray-600"></i>
                                    <p>Belum ada data guru.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($teachers->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $teachers->links('components.pagination') }}
                </div>
            @endif
        </div>

        <!-- Mobile: Card List -->
        <div class="md:hidden space-y-4">
            @forelse($teachers as $teacher)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $teacher->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $teacher->phone ?? '-' }}</p>
                        </div>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                            Guru
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.teachers.show', $teacher) }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-800">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.teachers.edit', $teacher) }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 hover:bg-amber-100 dark:hover:bg-amber-800">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus guru ini?');" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-red-50 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-800">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8 text-center text-gray-500 dark:text-gray-400">
                    <i class="fas fa-user-slash text-4xl mb-3 text-gray-300 dark:text-gray-600"></i>
                    <p>Belum ada data guru.</p>
                </div>
            @endforelse

            @if ($teachers->hasPages())
                <div class="mt-6">
                    {{ $teachers->links('components.pagination') }}
                </div>
            @endif
        </div>
    </div>
@endsection
