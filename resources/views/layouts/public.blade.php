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
    {{-- Header --}}
    <header class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 shadow-xl relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent"></div>
        <div class="absolute -top-4 -right-4 w-24 h-24 bg-white/10 rounded-full"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-indigo-500/20 rounded-full"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex justify-between items-center py-4 md:py-5">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('login') }}"
                        class="flex items-center gap-3 group transform transition-transform hover:scale-105">
                        <div class="relative">
                            <div
                                class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl p-2 flex items-center justify-center group-hover:bg-white/20 transition-all duration-300 shadow-lg border border-white/10">
                                <img src="{{ asset('images/school-logo.png') }}" alt="Logo Sekolah"
                                    class="h-8 w-8 object-contain">
                            </div>
                            <div
                                class="absolute -bottom-1 -right-1 w-4 h-4 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full border-2 border-blue-800 shadow-sm">
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span
                                class="text-lg md:text-xl font-bold text-white group-hover:text-blue-100 transition-colors">
                                MyPiketMu6
                            </span>
                            <span class="text-xs text-blue-100/80 mt-0.5">Sistem Informasi Absensi</span>
                        </div>
                    </a>
                </div>

                <!-- Waktu Real Time -->
                <div id="clock"
                    class="text-white font-semibold text-sm md:text-base bg-white/10 px-3 py-1.5 rounded-lg shadow-sm">
                    <!-- Jam akan muncul disini -->
                </div>
            </div>
        </div>
    </header>

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
        updateClock(); // panggil langsung saat pertama
    </script>
</body>

</html>
