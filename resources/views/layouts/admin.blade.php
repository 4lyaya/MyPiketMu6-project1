<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Panel</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom config -->
    <script>
        tailwind.config = {
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Top Bar -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-200">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Left: Logo & Toggle -->
                <div class="flex items-center gap-3">
                    <button data-drawer-target="sidebar" data-drawer-toggle="sidebar" aria-controls="sidebar"
                        class="inline-flex items-center p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500 lg:hidden">
                        <i class="fas fa-bars"></i>
                    </button>

                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                        <div
                            class="w-9 h-9 rounded-lg bg-primary-600 flex items-center justify-center text-white shadow">
                            <i class="fas fa-school"></i>
                        </div>
                        <span class="hidden sm:inline text-lg font-semibold text-gray-900">Sistem Absensi</span>
                    </a>
                </div>

                <!-- Right: User -->
                <div class="flex items-center gap-3">
                    <span class="hidden sm:block text-sm text-gray-600">Hi, <span
                            class="font-medium text-gray-900">{{ Auth::user()->name }}</span></span>
                    <button id="user-menu-button" data-dropdown-toggle="user-dropdown"
                        class="flex items-center justify-center w-9 h-9 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <i class="fas fa-user"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- User Dropdown -->
        <div id="user-dropdown"
            class="hidden z-50 w-48 bg-white rounded-xl shadow-xl border border-gray-200 divide-y divide-gray-100">
            <div class="px-4 py-3">
                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>
            <ul class="py-1 text-sm text-gray-700">
                <li>
                    <a href="{{ route('admin.profile') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                        <i class="fas fa-user-circle w-4"></i> Profil
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.settings.about') }}"
                        class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                        <i class="fas fa-cog w-4"></i> Pengaturan
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 w-full text-left px-4 py-2 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt w-4"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0">
        <div class="h-full px-3 pb-4 overflow-y-auto flex flex-col">

            <!-- Nav -->
            <nav class="space-y-2 flex-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 group {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-700' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.teachers.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 group {{ request()->routeIs('admin.teachers.*') ? 'bg-primary-50 text-primary-700' : '' }}">
                    <i class="fas fa-chalkboard-teacher w-5"></i>
                    <span class="font-medium">Guru</span>
                </a>

                <a href="{{ route('admin.classrooms.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 group {{ request()->routeIs('admin.classrooms.*') ? 'bg-primary-50 text-primary-700' : '' }}">
                    <i class="fas fa-school w-5"></i>
                    <span class="font-medium">Kelas</span>
                </a>

                <a href="{{ route('admin.absences.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 group {{ request()->routeIs('admin.absences.*') ? 'bg-primary-50 text-primary-700' : '' }}">
                    <i class="fas fa-clipboard-list w-5"></i>
                    <span class="font-medium">Absensi</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 group {{ request()->routeIs('admin.users.*') ? 'bg-primary-50 text-primary-700' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    <span class="font-medium">Pengguna</span>
                </a>

                <a href="{{ route('admin.exports.form') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-gray-700 hover:bg-primary-50 hover:text-primary-700 group {{ request()->routeIs('admin.exports.*') ? 'bg-primary-50 text-primary-700' : '' }}">
                    <i class="fas fa-file-export w-5"></i>
                    <span class="font-medium">Ekspor Data</span>
                </a>
            </nav>

            <!-- Footer Sidebar -->
            <div class="mt-auto pt-4 border-t border-gray-200">
                <div class="flex items-center gap-3 px-3 py-2">
                    <div
                        class="w-9 h-9 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                        <span class="text-xs text-gray-500">Administrator</span>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-16 min-h-screen">
        <div class="p-4 sm:p-6 lg:p-8">
            <!-- Alerts -->
            {{-- @if (session('success'))
                <div id="alert-success"
                    class="flex items-center gap-3 p-4 mb-5 text-green-800 rounded-xl bg-green-50 border border-green-200">
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
                    class="flex items-center gap-3 p-4 mb-5 text-red-800 rounded-xl bg-red-50 border border-red-200">
                    <i class="fas fa-exclamation-circle text-red-600"></i>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                    <button data-dismiss-target="#alert-error" aria-label="Close"
                        class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-200">
                        <i class="fas fa-times w-4 h-4"></i>
                    </button>
                </div>
            @endif --}}

            <!-- Content -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

    <script>
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
