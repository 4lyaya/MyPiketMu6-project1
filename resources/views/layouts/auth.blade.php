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
</head>

<body class="bg-blue-900 min-h-screen flex items-center justify-center p-4">
    <!-- Background pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.1\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"2\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
        </div>
    </div>

    <div
        class="w-full max-w-md bg-white rounded-xl shadow-2xl relative z-10 transform transition-all duration-300 hover:shadow-xl">
        <!-- Header -->
        <div class="bg-blue-800 rounded-t-xl p-6 text-center">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-inner">
                    <i class="fas fa-chalkboard-teacher text-blue-700 text-2xl"></i>
                </div>
            </div>
            <h1 class="text-2xl font-bold text-white">MyPiketMu6</h1>
            <p class="text-blue-100 mt-2">Sistem Manajemen Absensi</p>
        </div>

        <!-- Content -->
        <div class="p-6">
            <!-- Notifications -->
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

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <p class="text-red-700 text-sm">{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Content -->
            @yield('content')
        </div>

        <!-- Footer -->
        <div class="border-t border-gray-100 p-4 text-center bg-gray-50 rounded-b-xl">
            <p class="text-xs text-gray-600">
                @hasSection('auth-link')
                    @yield('auth-link')
                @else
                    &copy; {{ date('Y') }} MyPiketMu6. All rights reserved.
                @endif
            </p>
        </div>
    </div>
</body>

</html>
