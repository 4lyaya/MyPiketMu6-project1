@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h1>

    {{-- Error Message --}}
    @if ($errors->any())
        <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 rounded-lg">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500"
                required autofocus>
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password"
                class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500"
                required>
        </div>

        {{-- Button --}}
        <div>
            <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition">
                Masuk
            </button>
        </div>
    </form>
@endsection
