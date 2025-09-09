@extends('layouts.teachers')
@section('title', 'Tentang Aplikasi')
@section('subtitle', 'Informasi aplikasi absensi guru')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-gray-900">{{ $app['nama'] }}</h2>
                <p class="text-sm text-gray-500 mt-1">Versi {{ $app['versi'] }}</p>
            </div>

            <div class="mt-6 space-y-4 text-gray-700">
                <div>
                    <h3 class="font-semibold text-gray-800">Deskripsi</h3>
                    <p class="mt-1">{{ $app['deskripsi'] }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-800">Developer</h3>
                    <p class="mt-1">{{ $app['developer'] }}</p>
                </div>

                <div>
                    <h3 class="font-semibold text-gray-800">Tahun Rilis</h3>
                    <p class="mt-1">{{ $app['tahun'] }}</p>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('guru.dashboard') }}"
                    class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Kembali ke
                    Dashboard</a>
            </div>
        </div>
    </div>
@endsection
