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
        $app = [
            'nama' => config('app.name', 'Absensi Guru'),
            'versi' => '1.0.0',
            'deskripsi' => 'Aplikasi manajemen absensi dan penggantian guru secara daring, cepat, akurat, dan mudah digunakan.',
            'developer' => 'Tim IT SMK Muhammadiyah 6 Rogojampi',
            'tahun' => date('Y'),
            'logo' => asset('images/school-logo.png'),

            // Informasi Sekolah
            'sekolah' => [
                'nama' => 'SMK Muhammadiyah 6 Rogojampi',
                'alamat' => 'Jl. Raya Rogojampi No. 123, Rogojampi, Banyuwangi',
                'telepon' => '(0333) 123456',
                'email' => 'info@smkmu6rogojampi.sch.id',
                'website' => 'https://smkmu6rogojampi.sch.id',
            ],

            // Fitur Aplikasi
            'fitur' => [
                'Manajemen absensi guru secara daring',
                'Pencarian guru pengganti otomatis',
                'Laporan harian, mingguan, bulanan, & tahunan',
                'Ekspor data ke PDF',
                'Notifikasi real-time (coming soon)',
                'Akses role-based (Admin & Guru)',
            ],

            // Tim Developer
            'tim' => [
                ['nama' => 'Akmal Raditya Wijaya', 'role' => 'Lead Developer'],
                ['nama' => 'Mahiru Shiina', 'role' => 'Backend Developer'],
                ['nama' => 'Budi Santoso', 'role' => 'UI/UX Designer'],
                ['nama' => 'Dewi Lestari', 'role' => 'QA & Tester'],
            ],
        ];

        return view('teacher.settings.about', compact('app'));
    }
}