<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login - Sistem Absensi')</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .auth-background {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #60a5fa 100%);
            position: relative;
            overflow: hidden;
        }

        .auth-background::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            animation: float 20s linear infinite;
            pointer-events: none;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            100% {
                transform: translateY(-20px) rotate(360deg);
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-focus-effect:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .btn-hover-effect {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3), 0 2px 4px -1px rgba(59, 130, 246, 0.1);
        }

        .btn-hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.4), 0 4px 6px -2px rgba(59, 130, 246, 0.2);
        }
    </style>
</head>

<body class="auth-background min-h-screen flex items-center justify-center p-4 md:p-6">
    <!-- Main Container -->
    <div
        class="w-full max-w-md glass-effect rounded-2xl shadow-2xl overflow-hidden transform transition-all duration-500 scale-95 hover:scale-100">
        <!-- Header Section with Gradient -->
        <div class="bg-gradient-to-r from-blue-700 to-indigo-800 p-6 md:p-8 text-center relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="absolute top-1/4 left-1/4 w-20 h-20 bg-white rounded-full"></div>
                <div class="absolute bottom-1/3 right-1/4 w-16 h-16 bg-white rounded-full"></div>
                <div class="absolute top-1/3 right-1/3 w-12 h-12 bg-white rounded-full"></div>
            </div>

            <div class="relative z-10">
                <div class="flex justify-center mb-4">
                    <div
                        class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center shadow-lg backdrop-blur-sm border border-white/10 p-3">
                        <img src="{{ asset('images/school-logo.png') }}" alt="Logo Sekolah"
                            class="h-14 w-14 object-contain">
                    </div>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">MyPiketMu6</h1>
                <p class="text-blue-100 text-sm md:text-base opacity-90">Sistem Manajemen Absensi Guru</p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-6 md:p-8">
            <!-- Page Title -->
            <div class="text-center mb-6">
                <h2 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2">Selamat Datang Kembali</h2>
                <p class="text-gray-600 text-sm md:text-base">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <!-- Notifications -->
            @if (session('success'))
                <div class="mb-5 bg-green-50 border border-green-200 rounded-xl p-4 animate-fade-in">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-5 h-5 mt-0.5">
                            <i class="fas fa-check-circle text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 bg-red-50 border border-red-200 rounded-xl p-4 animate-fade-in">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-5 h-5 mt-0.5">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-red-700 text-sm font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 bg-red-50 border border-red-200 rounded-xl p-4 animate-fade-in">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-5 h-5 mt-0.5">
                            <i class="fas fa-exclamation-triangle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            @foreach ($errors->all() as $error)
                                <p class="text-red-700 text-sm font-medium mb-1 last:mb-0">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Content -->
            @yield('auth-content')
        </div>

        <!-- Footer -->
        <div class="border-t border-gray-100 p-5 text-center bg-gray-50">
            <p class="text-xs text-gray-600">
                @hasSection('auth-link')
                    @yield('auth-link')
                @else
                    &copy; {{ date('Y') }} MyPiketMu6 · Sistem Absensi Guru
                @endif
            </p>
        </div>
    </div>
</body>

</html>
