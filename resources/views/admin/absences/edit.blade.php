@extends('layouts.admin')

@section('title', 'Edit Absensi')

@section('content')
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Edit Absensi</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Perbarui data absensi guru</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form action="{{ route('admin.absences.update', $absence) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Tanggal -->
                <div>
                    <label for="replaced_at"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
                    <input type="date" id="replaced_at" name="replaced_at"
                        value="{{ old('replaced_at', $absence->replaced_at->format('Y-m-d')) }}"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('replaced_at') border-red-500 @enderror"
                        required>
                    @error('replaced_at')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Guru Absen -->
                <div>
                    <label for="absent_teacher_id"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Guru Absen</label>
                    <select id="absent_teacher_id" name="absent_teacher_id"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('absent_teacher_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ old('absent_teacher_id', $absence->absent_teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('absent_teacher_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Guru Pengganti -->
                <div>
                    <label for="substitute_teacher_id"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Guru Pengganti</label>
                    <select id="substitute_teacher_id" name="substitute_teacher_id"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('substitute_teacher_id') border-red-500 @enderror">
                        <option value="">-- Tidak ada --</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}"
                                {{ old('substitute_teacher_id', $absence->substitute_teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('substitute_teacher_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kelas -->
                <div>
                    <label for="classroom_id"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Kelas</label>
                    <select id="classroom_id" name="classroom_id"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('classroom_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}"
                                {{ old('classroom_id', $absence->classroom_id) == $classroom->id ? 'selected' : '' }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('classroom_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jam Pelajaran -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Jam Pelajaran</label>
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                        @php
                            $selectedPeriods = old('periods', $absence->getSelectedPeriods());
                        @endphp
                        @for ($i = 1; $i <= 10; $i++)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="periods[]" value="{{ $i }}"
                                    {{ in_array($i, $selectedPeriods) ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary-600 border-gray-300 dark:border-gray-600 dark:bg-gray-900 rounded focus:ring-primary-500">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Jam {{ $i }}</span>
                            </label>
                        @endfor
                    </div>
                    @error('periods')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alasan -->
                <div>
                    <label for="reason"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Alasan</label>
                    <select id="reason" name="reason"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('reason') border-red-500 @enderror">
                        <option value="">-- Pilih Alasan --</option>
                        <option value="sakit" {{ old('reason', $absence->reason) == 'sakit' ? 'selected' : '' }}>Sakit
                        </option>
                        <option value="alpha" {{ old('reason', $absence->reason) == 'alpha' ? 'selected' : '' }}>Alpha
                        </option>
                        <option value="izin" {{ old('reason', $absence->reason) == 'izin' ? 'selected' : '' }}>Izin
                        </option>
                        <option value="terlambat" {{ old('reason', $absence->reason) == 'terlambat' ? 'selected' : '' }}>
                            Terlambat</option>
                        <option value="tugas_sekolah"
                            {{ old('reason', $absence->reason) == 'tugas_sekolah' ? 'selected' : '' }}>Tugas Sekolah
                        </option>
                    </select>
                    @error('reason')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan -->
                <div>
                    <label for="note"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Catatan</label>
                    <textarea id="note" name="note" rows="3"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('note') border-red-500 @enderror"
                        placeholder="Tambahkan catatan tambahan (opsional)">{{ old('note', $absence->note) }}</textarea>
                    @error('note')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <a href="{{ route('admin.absences.index') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600">
                        <i class="fas fa-arrow-left"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg bg-primary-600 text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                        <i class="fas fa-save"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
