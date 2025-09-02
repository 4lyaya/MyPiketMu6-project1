<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-indigo-800 text-white shadow-lg">
        <div class="p-6 border-b border-indigo-700">
            <h1 class="text-xl font-bold">Sistem Absensi</h1>
            <p class="text-sm text-indigo-200 mt-1">Panel Admin</p>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-700' : '' }}">
                <i class="fas fa-tachometer-alt w-6 text-center"></i>
                <span class="ml-3">Dashboard</span>
            </a>

            <a href="{{ route('admin.teachers.index') }}"
                class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-all {{ request()->routeIs('admin.teachers.*') ? 'bg-indigo-700' : '' }}">
                <i class="fas fa-chalkboard-teacher w-6 text-center"></i>
                <span class="ml-3">Guru</span>
            </a>

            <a href="{{ route('admin.classrooms.index') }}"
                class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-all {{ request()->routeIs('admin.classrooms.*') ? 'bg-indigo-700' : '' }}">
                <i class="fas fa-school w-6 text-center"></i>
                <span class="ml-3">Kelas</span>
            </a>

            <a href="{{ route('admin.absences.index') }}"
                class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-all {{ request()->routeIs('admin.absences.*') ? 'bg-indigo-700' : '' }}">
                <i class="fas fa-clipboard-list w-6 text-center"></i>
                <span class="ml-3">Absensi</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
                class="flex items-center p-3 rounded-lg hover:bg-indigo-700 transition-all {{ request()->routeIs('admin.users.*') ? 'bg-indigo-700' : '' }}">
                <i class="fas fa-users w-6 text-center"></i>
                <span class="ml-3">Pengguna</span>
            </a>
        </nav>

        {{-- <div class="absolute bottom-0 w-full p-4 border-t border-indigo-700">
            <div class="text-sm text-indigo-200">
                <p>Login sebagai: <span class="font-semibold">{{ Auth::user()->name }}</span></p>
                <p class="text-xs mt-1">{{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
            </div>
        </div> --}}
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Navbar di atas konten -->
        <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-indigo-800">
                @yield('page-title', 'Dashboard')
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex flex-col text-right">
                    <span class="text-gray-700 text-sm font-semibold">{{ Auth::user()->name }}</span>
                    <span class="text-gray-500 text-xs">{{ Auth::user()->email }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex items-center transition-all">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </nav>

        <!-- Breadcrumb -->
        <div class="bg-white shadow-sm px-6 py-3 border-b">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                            <i class="fas fa-home mr-2"></i>Home
                        </a>
                    </li>
                    @hasSection('breadcrumb')
                        @yield('breadcrumb')
                    @endif
                </ol>
            </nav>
        </div>

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="m-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="m-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Konten utama -->
        <main class="flex-1 p-6 overflow-auto bg-gray-50">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-inner p-4 text-center text-sm text-gray-600">
            <p>&copy; {{ date('Y') }} Sistem Manajemen Absensi. All rights reserved.</p>
        </footer>
    </div>

    <!-- Script untuk interaktivitas -->
    <script>
        // Toggle sidebar untuk mobile (jika diperlukan)
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan logika JavaScript di sini jika diperlukan
            console.log('Admin panel loaded');
        });
    </script>
</body>

</html>
