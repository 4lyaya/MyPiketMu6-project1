@extends('layouts.teachers')

@section('title', 'Edit Absensi')

@php
    use App\Helpers\PeriodHelper;
    $selectedPeriods = old('periods', PeriodHelper::maskToPeriods($absence->periods_mask ?? 0));
@endphp

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Absensi</h1>

    <form action="{{ route('guru.absences.update', $absence) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        {{-- Tanggal --}}
        <div>
            <label class="block mb-1">Tanggal</label>
            <input type="date" name="replaced_at" value="{{ old('replaced_at', $absence->replaced_at->format('Y-m-d')) }}"
                class="w-full border px-3 py-2 rounded">
            @error('replaced_at')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Guru Absen --}}
        <div>
            <label class="block mb-1">Guru Absen</label>
            <select name="absent_teacher_id" class="w-full border px-3 py-2 rounded">
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}"
                        {{ old('absent_teacher_id', $absence->absent_teacher_id) == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
            @error('absent_teacher_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Guru Pengganti --}}
        <div>
            <label class="block mb-1">Guru Pengganti</label>
            <select name="substitute_teacher_id" class="w-full border px-3 py-2 rounded">
                <option value="">-- Tidak ada --</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}"
                        {{ old('substitute_teacher_id', $absence->substitute_teacher_id) == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
            @error('substitute_teacher_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kelas --}}
        <div>
            <label class="block mb-1">Kelas</label>
            <select name="classroom_id" class="w-full border px-3 py-2 rounded">
                @foreach ($classrooms as $classroom)
                    <option value="{{ $classroom->id }}"
                        {{ old('classroom_id', $absence->classroom_id) == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
            @error('classroom_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jam --}}
        <div>
            <label class="block mb-1">Jam Pelajaran</label>
            <div class="grid grid-cols-5 gap-2">
                @php
                    $selectedPeriods = old('periods', $absence->getSelectedPeriods());
                @endphp
                @for ($i = 1; $i <= 10; $i++)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="periods[]" value="{{ $i }}"
                            {{ in_array($i, $selectedPeriods) ? 'checked' : '' }}>
                        <span>Jam {{ $i }}</span>
                    </label>
                @endfor
            </div>
            @error('periods_mask')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Alasan --}}
        <div>
            <label class="block mb-1">Alasan</label>
            <select name="reason" class="w-full border px-3 py-2 rounded">
                <option value="">-- Pilih Alasan --</option>
                <option value="sakit" {{ old('reason', $absence->reason ?? '') == 'sakit' ? 'selected' : '' }}>Sakit
                </option>
                <option value="alpha" {{ old('reason', $absence->reason ?? '') == 'alpha' ? 'selected' : '' }}>Alpha
                </option>
                <option value="izin" {{ old('reason', $absence->reason ?? '') == 'izin' ? 'selected' : '' }}>Izin
                </option>
                <option value="terlambat" {{ old('reason', $absence->reason ?? '') == 'terlambat' ? 'selected' : '' }}>
                    Terlambat</option>
                <option value="tugas_sekolah"
                    {{ old('reason', $absence->reason ?? '') == 'tugas_sekolah' ? 'selected' : '' }}>Tugas Sekolah</option>
            </select>
            @error('reason')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Catatan --}}
        <div>
            <label class="block mb-1">Catatan</label>
            <textarea name="note" rows="3" class="w-full border px-3 py-2 rounded">{{ old('note', $absence->note) }}</textarea>
            @error('note')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-3">
            <a href="{{ route('guru.absences.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Update
            </button>
        </div>
    </form>
@endsection
