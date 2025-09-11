<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guru - @yield('title')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome 6.7.2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                    }
                }
            }
        }
    </script>

    <!-- Flicker-free dark-mode -->
    <script>
        // 1. Cek localStorage sebelum DOM muncul
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 font-sans text-gray-800 dark:text-gray-200">

    <!-- Top Bar -->
    <header
        class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-700">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Left: Logo & Toggle -->
                <div class="flex items-center gap-3">
                    <button id="sidebar-toggle"
                        class="lg:hidden text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>

                    <a href="{{ route('guru.dashboard') }}" class="flex items-center gap-2">
                        <div
                            class="w-9 h-9 rounded-lg bg-primary-600 flex items-center justify-center text-white shadow">
                            <i class="fas fa-school"></i>
                        </div>
                        <span
                            class="hidden sm:inline text-lg font-semibold text-gray-900 dark:text-white">MyPiketMu</span>
                    </a>
                </div>

                <!-- Right: Dark toggle + User -->
                <div class="flex items-center gap-3">
                    <!-- Dark mode toggle -->
                    <button id="theme-toggle"
                        class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 focus:outline-none">
                        <i id="theme-icon" class="fas fa-moon text-lg"></i>
                    </button>

                    <span class="hidden sm:block text-sm text-gray-600 dark:text-gray-300">Hi, <span
                            class="font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</span></span>
                    <button id="user-menu-button" data-dropdown-toggle="user-dropdown"
                        class="flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300 hover:bg-primary-200 dark:hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <i class="fas fa-user"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- User Dropdown -->
        <div id="user-dropdown"
            class="hidden z-50 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 divide-y divide-gray-100 dark:divide-gray-700">
            <div class="px-4 py-3">
                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ Auth::user()->email }}</p>
            </div>
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-300">
                <li>
                    <a href="{{ route('guru.settings.about') }}"
                        class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i class="fas fa-cog w-4"></i> Pengaturan
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-sign-out-alt w-4"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 transition-transform -translate-x-full bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 lg:translate-x-0">
        <div class="h-full px-3 pb-4 overflow-y-auto flex flex-col">

            <!-- Nav -->
            <nav class="space-y-2 flex-1">
                <a href="{{ route('guru.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-gray-700 hover:text-primary-700 dark:hover:text-primary-400 group {{ request()->routeIs('guru.dashboard') ? 'bg-primary-50 dark:bg-gray-700 text-primary-700 dark:text-primary-400' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="{{ route('guru.absences.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-gray-700 hover:text-primary-700 dark:hover:text-primary-400 group {{ request()->routeIs('guru.absences.*') ? 'bg-primary-50 dark:bg-gray-700 text-primary-700 dark:text-primary-400' : '' }}">
                    <i class="fas fa-clipboard-list w-5"></i>
                    <span class="font-medium">Absensi</span>
                </a>
                <a href="{{ route('guru.exports.form') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-primary-50 dark:hover:bg-gray-700 hover:text-primary-700 dark:hover:text-primary-400 group {{ request()->routeIs('guru.exports.*') ? 'bg-primary-50 dark:bg-gray-700 text-primary-700 dark:text-primary-400' : '' }}">
                    <i class="fas fa-file-export w-5"></i>
                    <span class="font-medium">Ekspor Data</span>
                </a>
            </nav>

            <!-- Footer Sidebar -->
            <div class="mt-auto pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3 px-3 py-2">
                    <div
                        class="w-9 h-9 rounded-full bg-primary-100 dark:bg-primary-900 text-primary-700 dark:text-primary-300 flex items-center justify-center font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Guru</span>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-16 min-h-screen">
        <div class="p-4 sm:p-6 lg:p-8">

            <!-- Notifications -->
            @if (session('success'))
                <div id="alert-success"
                    class="flex items-center gap-3 p-4 mb-5 text-green-800 dark:text-green-400 rounded-xl bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                    <button data-dismiss-target="#alert-success" aria-label="Close"
                        class="ml-auto -mx-1.5 -my-1.5 bg-green-50 dark:bg-green-900 text-green-500 dark:text-green-400 rounded-lg p-1.5 hover:bg-green-200 dark:hover:bg-green-800">
                        <i class="fas fa-times w-4 h-4"></i>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div id="alert-error"
                    class="flex items-center gap-3 p-4 mb-5 text-red-800 dark:text-red-400 rounded-xl bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700">
                    <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400"></i>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                    <button data-dismiss-target="#alert-error" aria-label="Close"
                        class="ml-auto -mx-1.5 -my-1.5 bg-red-50 dark:bg-red-900 text-red-500 dark:text-red-400 rounded-lg p-1.5 hover:bg-red-200 dark:hover:bg-red-800">
                        <i class="fas fa-times w-4 h-4"></i>
                    </button>
                </div>
            @endif

            <!-- Content -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 sm:p-6">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script>
        // Toggle sidebar
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });

        // Dark mode toggle
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');

        function updateIcon() {
            if (document.documentElement.classList.contains('dark')) {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }
        updateIcon();

        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
            updateIcon();
        });

        // Auto-hide alerts
        setTimeout(() => {
            ['alert-success', 'alert-error'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });
        }, 5000);
    </script>
</body>

</html>
