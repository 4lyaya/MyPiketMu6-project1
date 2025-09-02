<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .active-menu {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-blue-800 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                            <i class="fas fa-chalkboard-teacher text-blue-800 text-lg"></i>
                        </div>
                        <span class="text-lg font-semibold hidden sm:block">MyPiketMu</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('guru.dashboard') }}"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-colors flex items-center {{ request()->routeIs('guru.dashboard') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fas fa-tachometer-alt mr-2 text-sm"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('guru.absences.index') }}"
                        class="px-4 py-2 rounded-md text-sm font-medium transition-colors flex items-center {{ request()->routeIs('guru.absences.*') ? 'bg-blue-700 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fas fa-clipboard-list mr-2 text-sm"></i>
                        Absensi
                    </a>
                </div>

                <!-- User Info & Logout -->
                <div class="flex items-center space-x-4">
                    <div class="hidden sm:block text-right">
                        <div class="text-sm text-blue-100">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-blue-200">{{ Auth::user()->email }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-white text-blue-800 hover:bg-blue-100 px-3 py-2 rounded-md text-sm font-medium transition-colors flex items-center">
                            <i class="fas fa-sign-out-alt mr-2 text-sm"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>

                    <!-- Mobile menu button -->
                    <button type="button" id="mobile-menu-button"
                        class="md:hidden text-white p-2 rounded-md hover:bg-blue-700">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-blue-700 px-4 py-2">
            <div class="space-y-1">
                <a href="{{ route('guru.dashboard') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('guru.dashboard') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-blue-600 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                </a>
                <a href="{{ route('guru.absences.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('guru.absences.*') ? 'bg-blue-600 text-white' : 'text-blue-100 hover:bg-blue-600 hover:text-white' }}">
                    <i class="fas fa-clipboard-list mr-3"></i>Absensi
                </a>
                <div class="border-t border-blue-600 pt-2 mt-2">
                    <div class="px-3 py-2 text-blue-200 text-sm">
                        <i class="fas fa-user mr-2"></i>{{ Auth::user()->name }}
                    </div>
                    <div class="px-3 py-2 text-blue-300 text-xs">
                        <i class="fas fa-envelope mr-2"></i>{{ Auth::user()->email }}
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li>
                        <a href="{{ route('guru.dashboard') }}" class="hover:text-blue-600 transition-colors">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <span class="mx-2">/</span>
                        <span class="text-gray-800">@yield('breadcrumb', 'Dashboard')</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Notifications -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if (session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <p class="text-green-700 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                    <p class="text-red-700 text-sm">{{ session('error') }}</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-300">
                &copy; {{ date('Y') }} MyPiketMu - Sistem Manajemen Absensi
            </p>
        </div>
    </footer>

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
