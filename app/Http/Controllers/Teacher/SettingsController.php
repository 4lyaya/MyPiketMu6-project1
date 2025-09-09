<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function about()
    {
        $app = [
            'nama'        => config('app.name', 'Absensi Guru'),
            'versi'       => '1.0.0',
            'deskripsi'   => 'Aplikasi manajemen absensi dan penggantian guru secara daring.',
            'developer'   => 'Tim IT SMK Muhammadiyah 6 Rogojampi',
            'tahun'       => date('Y'),
            'logo'        => asset('img/logo.png'),
        ];

        return view('teacher.settings.about', compact('app'));
    }
}
