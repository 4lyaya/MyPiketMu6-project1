<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

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

        return view('admin.settings.about', compact('app'));
    }

    public function updateTheme(Request $request)
    {
        $request->validate(['theme' => 'required|in:light,dark']);
        session(['theme' => $request->theme]);
        return back()->with('success', 'Tema diperbarui.');
    }

    public function updateDateFormat(Request $request)
    {
        $request->validate(['date_format' => 'required|in:d-m-Y,Y-m-d,d/m/Y,Y/m/d']);
        session(['date_format' => $request->date_format]);
        return back()->with('success', 'Format tanggal diperbarui.');
    }
}