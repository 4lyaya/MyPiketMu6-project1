<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\{
    AbsenceController as TeacherAbsenceController,
    DashboardController as TeacherDashboardController,
    ExportAbsenceController,
    SettingsController as TeacherSettingsController
};

Route::middleware(['auth', 'guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');

        // Settings
        Route::get('/settings/about', [TeacherSettingsController::class, 'about'])->name('settings.about');

        // Export
        Route::prefix('exports')->name('exports.')->group(function () {
            Route::get('/form', [ExportAbsenceController::class, 'form'])->name('form');
            Route::post('/export', [ExportAbsenceController::class, 'export'])->name('export');
        });

        // Absensi (tanpa delete)
        Route::resource('absences', TeacherAbsenceController::class)->except('destroy');
    });