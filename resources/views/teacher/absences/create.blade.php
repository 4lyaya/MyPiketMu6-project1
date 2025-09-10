@extends('layouts.teachers')

@section('title', 'Tambah Absensi')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tambah Absensi</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Isi formulir untuk mencatat absensi guru</p>
            </div>
            <a href="{{ route('guru.absences.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <form action="{{ route('guru.absences.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Grid Form -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Guru Absen -->
                    <div>
                        <label for="absent_teacher_id"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Guru Absen <span class="text-red-500">*</span>
                        </label>
                        <select id="absent_teacher_id" name="absent_teacher_id" required
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('absent_teacher_id') border-red-500 @enderror">
                            <option value="">-- Pilih Guru --</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('absent_teacher_id') == $teacher->id ? 'selected' : '' }}>
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
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Guru Pengganti
                        </label>
                        <select id="substitute_teacher_id" name="substitute_teacher_id"
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('substitute_teacher_id') border-red-500 @enderror">
                            <option value="">-- Tidak ada --</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('substitute_teacher_id') == $teacher->id ? 'selected' : '' }}>
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
                        <label for="classroom_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select id="classroom_id" name="classroom_id" required
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('classroom_id') border-red-500 @enderror">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}"
                                    {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                    {{ $classroom->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('classroom_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label for="replaced_at" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Absen <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="replaced_at" name="replaced_at" value="{{ old('replaced_at') }}" required
                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('replaced_at') border-red-500 @enderror">
                        @error('replaced_at')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Jam Pelajaran -->
                <div>
                    <label class="block mb-3 text-sm font-medium text-gray-700 dark:text-gray-300">Jam Pelajaran <span
                            class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                        @php $selectedPeriods = old('periods', []); @endphp
                        @for ($i = 1; $i <= 10; $i++)
                            <label
                                class="flex items-center gap-2 p-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition">
                                <input type="checkbox" name="periods[]" value="{{ $i }}"
                                    {{ in_array($i, $selectedPeriods) ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary-600 border-gray-300 dark:border-gray-600 rounded focus:ring-primary-500">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Jam
                                    {{ $i }}</span>
                            </label>
                        @endfor
                    </div>
                    @error('periods')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alasan -->
                <div>
                    <label for="reason" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Alasan <span class="text-red-500">*</span>
                    </label>
                    <select id="reason" name="reason" required
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('reason') border-red-500 @enderror">
                        <option value="">-- Pilih Alasan --</option>
                        <option value="sakit" {{ old('reason') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="izin" {{ old('reason') == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="alpha" {{ old('reason') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                        <option value="terlambat" {{ old('reason') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                        <option value="tugas_sekolah" {{ old('reason') == 'tugas_sekolah' ? 'selected' : '' }}>Tugas
                            Sekolah</option>
                    </select>
                    @error('reason')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Catatan -->
                <div>
                    <label for="note"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Catatan</label>
                    <textarea id="note" name="note" rows="3" placeholder="Tambahkan catatan tambahan (opsional)"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('note') border-red-500 @enderror">{{ old('note') }}</textarea>
                    @error('note')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-primary-600 text-white rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition">
                        <i class="fas fa-save"></i>
                        Simpan Absensi
                    </button>
                    <a href="{{ route('guru.absences.index') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-600 transition">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Info Card -->
        <div class="bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 rounded-2xl p-5">
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-lg bg-primary-600 flex items-center justify-center text-white">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-primary-800 dark:text-primary-400 mb-1">Informasi Penting</p>
                    <p class="text-xs text-primary-700 dark:text-primary-300">
                        Pastikan data yang dimasukkan sudah benar. Data absensi akan digunakan untuk pelaporan kehadiran
                        guru.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
