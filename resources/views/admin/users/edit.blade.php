@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit User</h1>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border px-3 py-2 rounded"
                required>
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                class="w-full border px-3 py-2 rounded" required>
            @error('email')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1">Password <span class="text-gray-500">(Kosongkan jika tidak ingin
                    diubah)</span></label>
            <input type="password" name="password" class="w-full border px-3 py-2 rounded">
            @error('password')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded">
            @error('password_confirmation')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block mb-1">Role</label>
            <select name="role" class="w-full border px-3 py-2 rounded" required>
                <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-300 rounded">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
        </div>
    </form>
@endsection
