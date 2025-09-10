<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login - Sistem Absensi')</title>

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

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-primary-600 to-primary-700 dark:from-gray-900 dark:to-gray-800 min-h-screen flex items-center justify-center p-4">

    <!-- Flicker-free dark-mode -->
    <script>
        (function() {
            const stored = localStorage.theme;
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Main Container -->
    <div
        class="w-full max-w-md bg-white/95 dark:bg-gray-800/95 backdrop-blur-lg rounded-2xl shadow-2xl overflow-hidden relative">

        <!-- Dark-mode toggle (top-right) -->
        <div class="absolute top-4 right-4 z-10">
            <button id="theme-toggle"
                class="text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 focus:outline-none">
                <i id="theme-icon" class="fas fa-moon text-lg"></i>
            </button>
        </div>

        <!-- Header -->
        <div class="bg-primary-600 dark:bg-gray-900 p-6 text-center">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-white/20 dark:bg-white/10 rounded-xl flex items-center justify-center">
                    <img src="{{ asset('images/school-logo.png') }}" alt="Logo Sekolah"
                        class="h-10 w-10 object-contain">
                </div>
            </div>
            <h1 class="text-2xl font-bold text-white mb-1">MyPiketMu</h1>
            <p class="text-primary-100 dark:text-gray-300 text-sm">Sistem Manajemen Absensi Guru</p>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">

            <!-- Alerts -->
            @if (session('success'))
                <div
                    class="flex items-center gap-3 p-4 text-green-800 rounded-xl bg-green-50 border border-green-200 dark:bg-green-900/30 dark:border-green-700">
                    <i class="fas fa-check-circle text-green-600"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="flex items-center gap-3 p-4 text-red-800 rounded-xl bg-red-50 border border-red-200 dark:bg-red-900/30 dark:border-red-700">
                    <i class="fas fa-exclamation-circle text-red-600"></i>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="flex items-start gap-3 p-4 text-red-800 rounded-xl bg-red-50 border border-red-200 dark:bg-red-900/30 dark:border-red-700">
                    <i class="fas fa-exclamation-triangle text-red-600 mt-0.5"></i>
                    <div class="text-sm font-medium space-y-1">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Form Content -->
            @yield('auth-content')
        </div>

        <!-- Footer -->
        <div class="border-t border-gray-100 dark:border-gray-700 p-4 text-center bg-gray-50 dark:bg-gray-900">
            <p class="text-xs text-gray-600 dark:text-gray-400">
                @hasSection('auth-link')
                    @yield('auth-link')
                @else
                    &copy; {{ date('Y') }} MyPiketMu · Sistem Absensi Guru
                @endif
            </p>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script>
        // Dark-mode toggle
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
