<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{LoginController, RegisterController};
use App\Http\Controllers\PublicAbsenceController;

// Public Routes
Route::get('/', [PublicAbsenceController::class, 'index'])->name('home');
Route::get('/absences', [PublicAbsenceController::class, 'index'])->name('public.absences.index');
Route::get('/absences/{absence}', [PublicAbsenceController::class, 'show'])->name('public.absences.show');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Post-Login Redirect
Route::get('/redirect', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'guru' => redirect()->route('guru.dashboard'),
            default => redirect()->route('login'),
        };
    }
    return redirect()->route('login');
})->name('redirect');

// Admin Routes
require __DIR__ . '/admin.php';

// Teacher Routes
require __DIR__ . '/teacher.php';