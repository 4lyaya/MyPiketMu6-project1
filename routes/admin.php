<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AbsenceController as AdminAbsenceController,
    BackupController,
    ClassroomController as AdminClassroomController,
    DashboardController as AdminDashboardController,
    ExportAbsenceController,
    ImportController,
    ProfileController as AdminProfileController,
    SettingsController as AdminSettingsController,
    TeacherController as AdminTeacherController,
    UserController as AdminUserController
};

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile');
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password');

        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [AdminSettingsController::class, 'index'])->name('index');
            Route::post('/theme', [AdminSettingsController::class, 'updateTheme'])->name('theme');
            Route::post('/date', [AdminSettingsController::class, 'updateDateFormat'])->name('date');
            Route::get('/about', [AdminSettingsController::class, 'about'])->name('about');
            Route::get('/backup', fn() => view('admin.settings.backup'))->name('backup');
        });

        // Backup
        Route::post('/backup/full/{type}', [BackupController::class, 'full'])->name('backup.full');
        Route::post('/backup/partial/{table}/{type}', [BackupController::class, 'partial'])->name('backup.partial');

        // Export
        Route::prefix('exports')->name('exports.')->group(function () {
            Route::get('/form', [ExportAbsenceController::class, 'form'])->name('form');
            Route::post('/export', [ExportAbsenceController::class, 'export'])->name('export');
        });

        // Import
        Route::prefix('import')->name('import')->group(function () {
            Route::get('/', [ImportController::class, 'index']);
            Route::post('/teachers', [ImportController::class, 'importTeachers'])->name('.teachers');
            Route::post('/classrooms', [ImportController::class, 'importClassrooms'])->name('.classrooms');
        });

        // Resource CRUD
        Route::resource('absences', AdminAbsenceController::class)->except('destroy');
        Route::resource('classrooms', AdminClassroomController::class);
        Route::resource('teachers', AdminTeacherController::class);
        Route::resource('users', AdminUserController::class);
    });
