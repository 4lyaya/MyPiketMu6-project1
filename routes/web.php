<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AbsenceController as AdminAbsenceController;
use App\Http\Controllers\Admin\ClassroomController as AdminClassroomController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\AbsenceController as TeacherAbsenceController;
use App\Http\Controllers\PublicAbsenceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes (bisa diakses tanpa login) - HARUS di atas auth middleware
Route::get('/', [PublicAbsenceController::class, 'index'])->name('home');
Route::get('/absences', [PublicAbsenceController::class, 'index'])->name('public.absences.index');
Route::get('/absences/{absence}', [PublicAbsenceController::class, 'show'])->name('public.absences.show');

// Rute untuk autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout (bisa diakses oleh semua user yang terautentikasi)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');

    // Settings
    Route::get('/settings/about', [App\Http\Controllers\Admin\SettingsController::class, 'about'])->name('settings.about');

    // Export Mpdf
    Route::get('/exports/form', [App\Http\Controllers\Admin\ExportAbsenceController::class, 'form'])->name('exports.form');
    Route::post('/exports/export', [App\Http\Controllers\Admin\ExportAbsenceController::class, 'export'])->name('exports.export');

    // Kelola Absensi
    Route::get('/absences', [AdminAbsenceController::class, 'index'])->name('absences.index');
    Route::get('/absences/create', [AdminAbsenceController::class, 'create'])->name('absences.create');
    Route::post('/absences', [AdminAbsenceController::class, 'store'])->name('absences.store');
    Route::get('/absences/{absence}', [AdminAbsenceController::class, 'show'])->name('absences.show');
    Route::get('/absences/{absence}/edit', [AdminAbsenceController::class, 'edit'])->name('absences.edit');
    Route::put('/absences/{absence}', [AdminAbsenceController::class, 'update'])->name('absences.update');
    Route::delete('/absences/{absence}', [AdminAbsenceController::class, 'destroy'])->name('absences.destroy');

    // Kelola Kelas
    Route::get('/classrooms', [AdminClassroomController::class, 'index'])->name('classrooms.index');
    Route::get('/classrooms/create', [AdminClassroomController::class, 'create'])->name('classrooms.create');
    Route::post('/classrooms', [AdminClassroomController::class, 'store'])->name('classrooms.store');
    Route::get('/classrooms/{classroom}', [AdminClassroomController::class, 'show'])->name('classrooms.show');
    Route::get('/classrooms/{classroom}/edit', [AdminClassroomController::class, 'edit'])->name('classrooms.edit');
    Route::put('/classrooms/{classroom}', [AdminClassroomController::class, 'update'])->name('classrooms.update');
    Route::delete('/classrooms/{classroom}', [AdminClassroomController::class, 'destroy'])->name('classrooms.destroy');

    // Kelola Guru
    Route::get('/teachers', [AdminTeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/create', [AdminTeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [AdminTeacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/{teacher}', [AdminTeacherController::class, 'show'])->name('teachers.show');
    Route::get('/teachers/{teacher}/edit', [AdminTeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{teacher}', [AdminTeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{teacher}', [AdminTeacherController::class, 'destroy'])->name('teachers.destroy');

    // Kelola User
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});

// Rute untuk guru
Route::middleware(['auth', 'guru'])->prefix('guru')->name('guru.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('/settings/about', [App\Http\Controllers\Teacher\SettingsController::class, 'about'])->name('settings.about');

    // Kelola Absensi (tanpa delete)
    Route::get('/absences', [TeacherAbsenceController::class, 'index'])->name('absences.index');
    Route::get('/absences/create', [TeacherAbsenceController::class, 'create'])->name('absences.create');
    Route::post('/absences', [TeacherAbsenceController::class, 'store'])->name('absences.store');
    Route::get('/absences/{absence}', [TeacherAbsenceController::class, 'show'])->name('absences.show');
    Route::get('/absences/{absence}/edit', [TeacherAbsenceController::class, 'edit'])->name('absences.edit');
    Route::put('/absences/{absence}', [TeacherAbsenceController::class, 'update'])->name('absences.update');
});

// Redirect untuk user yang sudah login mengakses root
Route::get('/redirect', function () {
    if (auth()->check()) {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'guru') {
            return redirect()->route('guru.dashboard');
        }
    }

    return redirect()->route('login');
})->name('redirect');
