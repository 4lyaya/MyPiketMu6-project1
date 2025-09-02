@extends('layouts.teachers')

@section('title', 'Edit Absensi')
@section('breadcrumb', 'Edit Absensi')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Edit Absensi</h1>
                <p class="text-gray-600 text-sm mt-1">Perbarui data absensi</p>
            </div>
            <a href="{{ route('guru.absences.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <!-- Form -->
        <form action="{{ route('guru.absences.update', $absence) }}" method="POST"
            class="bg-white rounded-lg border border-gray-200 p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tanggal -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal *</label>
                    <input type="date" name="replaced_at"
                        value="{{ old('replaced_at', $absence->replaced_at->format('Y-m-d')) }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    @error('replaced_at')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Guru Absen -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Guru Absen *</label>
                    <select name="absent_teacher_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ old('absent_teacher_id', $absence->absent_teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('absent_teacher_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Guru Pengganti -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Guru Pengganti</label>
                    <select name="substitute_teacher_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="">Tidak ada pengganti</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ old('substitute_teacher_id', $absence->substitute_teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('substitute_teacher_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kelas -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelas *</label>
                    <select name="classroom_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}"
                                {{ old('classroom_id', $absence->classroom_id) == $classroom->id ? 'selected' : '' }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('classroom_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Jam Pelajaran -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Jam Pelajaran *</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                    @php
                        $selectedPeriods = old('periods', $absence->getSelectedPeriods());
                    @endphp
                    @for ($i = 1; $i <= 10; $i++)
                        <label
                            class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer transition-colors">
                            <input type="checkbox" name="periods[]" value="{{ $i }}"
                                {{ in_array($i, $selectedPeriods) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mr-3">
                            <span class="text-sm font-medium">Jam {{ $i }}</span>
                        </label>
                    @endfor
                </div>
                @error('periods')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alasan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alasan *</label>
                <select name="reason" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    <option value="">Pilih Alasan</option>
                    <option value="sakit" {{ old('reason', $absence->reason) == 'sakit' ? 'selected' : '' }}>Sakit
                    </option>
                    <option value="izin" {{ old('reason', $absence->reason) == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="alpha" {{ old('reason', $absence->reason) == 'alpha' ? 'selected' : '' }}>Alpha
                    </option>
                    <option value="terlambat" {{ old('reason', $absence->reason) == 'terlambat' ? 'selected' : '' }}>
                        Terlambat</option>
                    <option value="tugas_sekolah"
                        {{ old('reason', $absence->reason) == 'tugas_sekolah' ? 'selected' : '' }}>Tugas Sekolah</option>
                </select>
                @error('reason')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                <textarea name="note" rows="3" placeholder="Tambahkan catatan (opsional)"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ old('note', $absence->note) }}</textarea>
                @error('note')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('guru.absences.index') }}"
                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-sm font-medium text-center">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i>Update Absensi
                </button>
            </div>
        </form>
    </div>
@endsection
