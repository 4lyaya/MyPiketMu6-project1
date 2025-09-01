<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - @yield('title')</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .active-menu {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0.375rem;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-indigo-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <i class="fas fa-chalkboard-teacher text-2xl mr-2"></i>
                    <span class="text-xl font-bold">Sistem Absensi Guru</span>
                </div>

                <!-- Menu navigasi (Desktop) -->
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('guru.dashboard') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-600 transition-all flex items-center {{ request()->routeIs('guru.dashboard') ? 'active-menu' : '' }}">
                        <i class="fas fa-tachometer-alt mr-2"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('guru.absences.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-600 transition-all flex items-center {{ request()->routeIs('guru.absences.*') ? 'active-menu' : '' }}">
                        <i class="fas fa-clipboard-list mr-2"></i>
                        Absensi
                    </a>
                </div>

                <!-- Kanan: User + Logout -->
                <div class="flex items-center space-x-4">
                    <div class="hidden md:block">
                        <span class="text-sm">{{ Auth::user()->name }}</span>
                        <span class="text-xs block text-indigo-200">{{ Auth::user()->email }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center transition-all">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span class="hidden md:inline">Logout</span>
                        </button>
                    </form>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="text-white focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu (hidden by default) -->
        <div id="mobile-menu" class="md:hidden hidden bg-indigo-800 px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('guru.dashboard') }}"
                class="block px-3 py-2 rounded-md text-base font-medium hover:bg-indigo-600 {{ request()->routeIs('guru.dashboard') ? 'active-menu' : '' }}">
                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
            </a>
            <a href="{{ route('guru.absences.index') }}"
                class="block px-3 py-2 rounded-md text-base font-medium hover:bg-indigo-600 {{ request()->routeIs('guru.absences.*') ? 'active-menu' : '' }}">
                <i class="fas fa-clipboard-list mr-2"></i>Absensi
            </a>
            <div class="pt-4 border-t border-indigo-600">
                <p class="px-3 py-2 text-indigo-200">{{ Auth::user()->name }}</p>
                <p class="px-3 py-2 text-xs text-indigo-300">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('guru.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                            <i class="fas fa-home mr-2"></i>Dashboard
                        </a>
                    </li>
                    @hasSection('breadcrumb')
                        @yield('breadcrumb')
                    @endif
                </ol>
            </nav>
        </div>
    </div>

    <!-- Notifikasi -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Content -->
    <main class="flex-1 max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 w-full">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} Sistem Absensi Guru. All rights reserved.</p>
        </div>
    </footer>

    <!-- Script untuk mobile menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Tutup mobile menu ketika klik di luar
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                    mobileMenu.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>
