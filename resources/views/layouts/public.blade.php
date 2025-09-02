<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Absensi - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-blue-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('login') }}" class="flex items-center gap-3 group">
                        <div class="relative">
                            <div
                                class="w-12 h-12 bg-white rounded-lg p-2 flex items-center justify-center group-hover:bg-blue-50 transition-colors shadow-sm">
                                <img src="{{ asset('images/school-logo.png') }}" alt="Logo Sekolah"
                                    class="h-8 w-8 object-contain">
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 rounded-full border-2 border-white">
                            </div>
                        </div>
                        <div class="hidden sm:flex flex-col">
                            <span class="text-lg font-semibold text-white group-hover:text-blue-100 transition-colors">
                                MyPiketMu6
                            </span>
                            <span class="text-xs text-blue-200">Sistem Informasi Absensi</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Menu untuk Public -->
                {{-- <nav class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('public.absences.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors {{ request()->routeIs('public.absences.index') ? 'bg-blue-700' : '' }}">
                        <i class="fas fa-list mr-1"></i> Daftar Absensi
                    </a>
                    <a href="{{ route('login') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login Staff
                    </a>
                </nav> --}}

                <!-- Mobile menu button -->
                {{-- <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="text-white p-2 rounded-md hover:bg-blue-700">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div> --}}
            </div>
        </div>

        <!-- Mobile Menu -->
        {{-- <div id="mobile-menu" class="md:hidden hidden bg-blue-700 px-3 py-2">
            <div class="space-y-1">
                <a href="{{ route('public.absences.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-600 {{ request()->routeIs('public.absences.index') ? 'bg-blue-600' : '' }}">
                    <i class="fas fa-list mr-2"></i> Daftar Absensi
                </a>
                <a href="{{ route('login') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-600">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login Staff
                </a>
            </div>
        </div> --}}
    </header>

    <!-- Breadcrumb Navigation -->
    {{-- <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('public.absences.index') }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <span class="text-gray-400 mx-2">/</span>
                        <span class="text-gray-600">@yield('breadcrumb', 'Beranda')</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div> --}}

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6">
        <!-- Notifications -->
        @if (session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <p class="text-green-700 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <p class="text-red-700 text-sm">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    {{-- <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">MyPiketMu6</h3>
                    <p class="text-gray-300 text-sm">
                        Sistem informasi absensi terintegrasi untuk memantau kehadiran guru dan staff.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('public.absences.index') }}"
                                class="text-gray-300 hover:text-white transition-colors">Daftar Absensi</a></li>
                        <li><a href="{{ route('login') }}"
                                class="text-gray-300 hover:text-white transition-colors">Login Staff</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                    <div class="space-y-2 text-sm text-gray-300">
                        <p><i class="fas fa-envelope mr-2"></i> info@mypiketmu6.example</p>
                        <p><i class="fas fa-phone mr-2"></i> (021) 1234-5678</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                <p class="text-sm text-gray-300">
                    &copy; {{ date('Y') }} MyPiketMu6. All rights reserved.
                </p>
            </div>
        </div>
    </footer> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(e) {
                if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
