@extends('layouts.admin')

@section('title', 'Daftar Kelas')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Daftar Kelas</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data kelas yang tersedia</p>
            </div>
            <a href="{{ route('admin.classrooms.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition">
                <i class="fas fa-plus"></i>
                Tambah Kelas
            </a>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div id="alert-success"
                class="flex items-center gap-3 p-4 mb-5 text-green-800 rounded-xl bg-green-50 border border-green-200">
                <i class="fas fa-check-circle text-green-600"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button data-dismiss-target="#alert-success" aria-label="Close"
                    class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200">
                    <i class="fas fa-times w-4 h-4"></i>
                </button>
            </div>
        @endif

        <!-- Desktop: Table Card -->
        <div class="hidden md:block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Nama Kelas
                            </th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($classrooms as $classroom)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">
                                    {{ ($classrooms->currentPage() - 1) * $classrooms->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">{{ $classroom->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.classrooms.show', $classroom) }}"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-blue-50 text-blue-700 hover:bg-blue-100">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('admin.classrooms.edit', $classroom) }}"
                                            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-amber-50 text-amber-700 hover:bg-amber-100">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.classrooms.destroy', $classroom) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kelas ini?');" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-md bg-red-50 text-red-700 hover:bg-red-100">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-10 text-center text-gray-500">
                                    <i class="fas fa-school text-4xl mb-3 text-gray-300"></i>
                                    <p>Belum ada data kelas.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($classrooms->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $classrooms->links('components.pagination') }}
                </div>
            @endif
        </div>

        <!-- Mobile: Card List -->
        <div class="md:hidden space-y-4">
            @forelse($classrooms as $classroom)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-gray-900">{{ $classroom->name }}</p>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                            Kelas
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.classrooms.show', $classroom) }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-blue-50 text-blue-700 hover:bg-blue-100">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.classrooms.edit', $classroom) }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-amber-50 text-amber-700 hover:bg-amber-100">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.classrooms.destroy', $classroom) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus kelas ini?');" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-medium rounded-md bg-red-50 text-red-700 hover:bg-red-100">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center text-gray-500">
                    <i class="fas fa-school text-4xl mb-3 text-gray-300"></i>
                    <p>Belum ada data kelas.</p>
                </div>
            @endforelse

            @if ($classrooms->hasPages())
                <div class="mt-6">
                    {{ $classrooms->links('components.pagination') }}
                </div>
            @endif
        </div>
    </div>
@endsection
