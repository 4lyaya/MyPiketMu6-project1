<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Menampilkan halaman informasi aplikasi untuk guru.
     */
    public function about()
    {
        // Data aplikasi (bisa juga pindahkan ke config jika ingin lebih rapi)
        $app = [
            'nama' => config('app.name', 'MyPiketMu'),
            'versi' => '1.0.0',
            'deskripsi' => 'Aplikasi manajemen absensi dan penggantian guru secara daring.',
            'developer' => 'Tim IT SMK Muhammadiyah 6 Rogojampi',
            'tahun' => date('Y'),
            'logo' => asset('images/school-logo.png'),
        ];

        return view('teacher.settings.about', compact('app'));
    }
}