@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="max-w-2xl mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Edit User</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi user</p>
        </div>

        <!-- Alert Error -->
        @if ($errors->any())
            <div id="alert-error"
                class="flex items-center gap-3 p-4 mb-5 text-red-800 rounded-xl bg-red-50 border border-red-200">
                <i class="fas fa-exclamation-circle text-red-600"></i>
                <ul class="text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button data-dismiss-target="#alert-error" aria-label="Close"
                    class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-200">
                    <i class="fas fa-times w-4 h-4"></i>
                </button>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('name') border-red-500 @enderror"
                        placeholder="Masukkan nama user" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('email') border-red-500 @enderror"
                        placeholder="Contoh: user@example.com" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700">
                        Password
                        <span class="text-gray-500 font-normal">(Kosongkan jika tidak ingin diubah)</span>
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('password') border-red-500 @enderror"
                        placeholder="Masukkan password baru">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Konfirmasi
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('password_confirmation') border-red-500 @enderror"
                        placeholder="Masukkan kembali password baru">
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('role') border-red-500 @enderror"
                        required>
                        <option value="guru" {{ old('role', $user->role) == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <a href="{{ route('admin.users.index') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <i class="fas fa-arrow-left"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg bg-primary-600 text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition">
                        <i class="fas fa-save"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
