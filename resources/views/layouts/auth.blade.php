<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Absensi')</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .auth-bg {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body class="auth-bg min-h-screen flex items-center justify-center p-4">
    <!-- Latar belakang dengan pola -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.2\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"2\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>
    </div>

    <div class="w-full max-w-md p-6 bg-white shadow-xl rounded-2xl card-hover relative z-10">
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-indigo-600 text-2xl"></i>
                </div>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Sistem Absensi</h1>
            <p class="text-gray-600 mt-2">@yield('subtitle', 'Selamat datang')</p>
        </div>

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <p class="text-sm">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Konten Form -->
        @yield('content')

        <!-- Footer -->
        <div class="mt-6 pt-4 border-t border-gray-200 text-center">
            <p class="text-sm text-gray-600">
                @hasSection('auth-link')
                    @yield('auth-link')
                @else
                    &copy; {{ date('Y') }} Sistem Absensi. All rights reserved.
                @endif
            </p>
        </div>
    </div>

    <!-- Efek visual tambahan -->
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-white opacity-5"></div>
</body>

</html>
