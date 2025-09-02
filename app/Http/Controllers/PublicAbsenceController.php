<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Teacher;
use Illuminate\Http\Request;

class PublicAbsenceController extends Controller
{
    public function index()
    {
        $query = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])
            ->latest('replaced_at');

        // Filter by month (opsional)
        if (request('month')) {
            $query->whereMonth('replaced_at', request('month'));
        }

        // Filter by year (opsional)
        if (request('year')) {
            $query->whereYear('replaced_at', request('year'));
        }

        // Filter by teacher (opsional)
        if (request('teacher')) {
            $query->where('absent_teacher_id', request('teacher'));
        }

        $absences = $query->paginate(10);

        // Ambil semua teacher
        $teachers = Teacher::all();

        // Statistics - semua data
        $totalAbsences = Absence::count();
        $totalSubstitutions = Absence::whereNotNull('substitute_teacher_id')->count();
        $uniqueTeachers = Absence::distinct('absent_teacher_id')->count('absent_teacher_id');

        return view('public.absences.index', compact('absences', 'teachers', 'totalAbsences', 'totalSubstitutions', 'uniqueTeachers'));
    }

    public function show(Absence $absence)
    {
        $absence->load(['absentTeacher', 'substituteTeacher', 'classroom']);

        return view('public.absences.show', compact('absence'));
    }
}