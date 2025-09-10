<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Absensi - @yield('title')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
    <header class="bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <a href="{{ route('login') }}" class="flex items-center gap-3 hover:opacity-90 transition">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <img src="{{ asset('images/school-logo.png') }}" alt="Logo Sekolah"
                            class="h-6 w-6 object-contain">
                    </div>
                    <div>
                        <p class="text-lg font-bold">MyPiketMu</p>
                        <p class="text-xs text-primary-100">Sistem Informasi Absensi</p>
                    </div>
                </a>

                <!-- Right: Clock + Dark Toggle -->
                <div class="flex items-center gap-3">
                    <!-- Clock -->
                    <div id="clock" class="bg-white/10 rounded-lg px-3 py-1.5 text-sm font-medium"></div>

                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" class="text-white hover:text-primary-100 focus:outline-none">
                        <i id="theme-icon" class="fas fa-moon text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Alerts -->
        @if (session('success'))
            <div id="alert-success"
                class="flex items-center gap-3 p-4 mb-6 text-green-800 rounded-xl bg-green-50 border border-green-200 dark:bg-green-900/30 dark:border-green-700">
                <i class="fas fa-check-circle text-green-600"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button data-dismiss-target="#alert-success" aria-label="Close"
                    class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200">
                    <i class="fas fa-times w-4 h-4"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="alert-error"
                class="flex items-center gap-3 p-4 mb-6 text-red-800 rounded-xl bg-red-50 border border-red-200 dark:bg-red-900/30 dark:border-red-700">
                <i class="fas fa-exclamation-circle text-red-600"></i>
                <span class="text-sm font-medium">{{ session('error') }}</span>
                <button data-dismiss-target="#alert-error" aria-label="Close"
                    class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-200">
                    <i class="fas fa-times w-4 h-4"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script>
        // Real-time clock
        function updateClock() {
            const options = {
                timeZone: 'Asia/Jakarta',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            const now = new Date().toLocaleTimeString('id-ID', options);
            document.getElementById('clock').textContent = now + ' WIB';
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Auto-hide alerts
        setTimeout(() => {
            ['alert-success', 'alert-error'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });
        }, 5000);

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
    </script>
</body>

</html>
