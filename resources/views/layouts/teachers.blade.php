<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .nav-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
        }

        .active-menu {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 8px;
        }

        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }

        .card-hover {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .mobile-menu-open {
                display: block;
                animation: slideDown 0.3s ease-out;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="nav-gradient text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('guru.dashboard') }}" class="flex items-center gap-3 group">
                        <div
                            class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center p-1.5 border border-white/10 shadow-sm">
                            <img src="{{ asset('images/school-logo.png') }}" alt="Logo Sekolah"
                                class="h-7 w-7 object-contain">
                        </div>
                        <div class="hidden sm:flex flex-col">
                            <span class="text-lg font-semibold text-white group-hover:text-blue-100 transition-colors">
                                MyPiketMu
                            </span>
                            <span class="text-xs text-blue-100/80">Portal Guru</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('guru.dashboard') }}"
                        class="px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 flex items-center {{ request()->routeIs('guru.dashboard') ? 'active-menu text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-tachometer-alt mr-2 text-sm"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('guru.absences.index') }}"
                        class="px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 flex items-center {{ request()->routeIs('guru.absences.*') ? 'active-menu text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                        <i class="fas fa-clipboard-list mr-2 text-sm"></i>
                        Absensi
                    </a>
                </div>

                <!-- User Info & Logout -->
                <div class="flex items-center space-x-3">
                    <div class="hidden sm:block text-right">
                        <div class="text-sm font-medium text-white">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-blue-100/90">{{ Auth::user()->email }}</div>
                    </div>

                    <!-- User Avatar -->
                    <div
                        class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center border border-white/20">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-white/10 hover:bg-white/20 text-white px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center border border-white/20 backdrop-blur-sm">
                            <i class="fas fa-sign-out-alt mr-1.5 text-sm"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>

                    <!-- Mobile menu button -->
                    <button type="button" id="mobile-menu-button"
                        class="md:hidden text-white p-2 rounded-lg hover:bg-white/10 transition-colors">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="md:hidden hidden bg-blue-700/95 backdrop-blur-sm px-4 py-3 border-t border-blue-600/50">
            <div class="space-y-2">
                <a href="{{ route('guru.dashboard') }}"
                    class="block px-3 py-2.5 rounded-lg text-base font-medium transition-colors {{ request()->routeIs('guru.dashboard') ? 'bg-white/15 text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                </a>
                <a href="{{ route('guru.absences.index') }}"
                    class="block px-3 py-2.5 rounded-lg text-base font-medium transition-colors {{ request()->routeIs('guru.absences.*') ? 'bg-white/15 text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
                    <i class="fas fa-clipboard-list mr-3"></i>Absensi
                </a>

                <!-- User Info in Mobile -->
                <div class="border-t border-blue-600/50 pt-3 mt-3">
                    <div class="px-3 py-2 text-white text-sm font-medium flex items-center">
                        <i class="fas fa-user mr-2 text-sm"></i>{{ Auth::user()->name }}
                    </div>
                    <div class="px-3 py-2 text-blue-100 text-xs flex items-center">
                        <i class="fas fa-envelope mr-2 text-sm"></i>{{ Auth::user()->email }}
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li>
                        <a href="{{ route('guru.dashboard') }}"
                            class="hover:text-blue-600 transition-colors flex items-center">
                            <i class="fas fa-home mr-1.5 text-xs"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-gray-800 font-medium">@yield('breadcrumb', 'Dashboard')</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Notifications -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if (session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 rounded-xl p-4 animate-fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-5 h-5 text-green-500">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-50 border border-red-200 rounded-xl p-4 animate-fade-in">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-5 h-5 text-red-500">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-red-700 text-sm font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6">
        <!-- Page Header -->
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">@yield('title', 'Dashboard Guru')</h1>
            <p class="text-gray-600 text-sm md:text-base">@yield('subtitle', 'Selamat datang di portal guru MyPiketMu')</p>
        </div>

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center mr-3">
                        <img src="{{ asset('images/school-logo.png') }}" alt="Logo Sekolah"
                            class="h-5 w-5 object-contain">
                    </div>
                    <p class="text-sm text-gray-300">
                        MyPiketMu - Sistem Manajemen Absensi
                    </p>
                </div>
                <div class="text-sm text-gray-400">
                    &copy; {{ date('Y') }} All rights reserved
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');
                mobileMenu.classList.toggle('mobile-menu-open');
            });

            document.addEventListener('click', function(e) {
                if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('mobile-menu-open');
                }
            });

            // Close menu when clicking outside on mobile
            if (window.innerWidth < 768) {
                document.addEventListener('click', function(e) {
                    if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.classList.remove('mobile-menu-open');
                    }
                });
            }
        });
    </script>
</body>

</html>
