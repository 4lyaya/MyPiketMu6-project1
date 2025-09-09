<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. hak akses
        if (Auth::user()->role !== 'guru' && Auth::user()->role !== 'admin') {
            abort(403);
        }

        // 2. data absen terbaru
        $absences = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])
            ->latest('created_at')
            ->take(3)
            ->get();

        // 3. statistik sederhana (dari seluruh tabel)
        $totalAbsences      = Absence::count();
        $totalSubstitutions = Absence::whereNotNull('substitute_teacher_id')->count();
        $uniqueTeachers     = Absence::distinct('absent_teacher_id')->count('absent_teacher_id');

        // 4. kirim ke view
        return view('teacher.dashboard', compact(
            'absences',
            'totalAbsences',
            'totalSubstitutions',
            'uniqueTeachers'
        ));
    }
}
