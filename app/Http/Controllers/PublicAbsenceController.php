<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PublicAbsenceController extends Controller
{
    public function index()
    {
        // Query dasar untuk absences
        $query = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])
            ->latest('created_at'); // ganti jadi created_at

        // Query untuk statistik (menggunakan filter yang sama)
        $statsQuery = Absence::query();

        // Filter by date (bisa YYYY / YYYY-MM / YYYY-MM-DD)
        $hasDateFilter = false;
        if ($date = request('date')) {
            try {
                $carbonDate = Carbon::parse($date);
                $hasDateFilter = true;

                if (strlen($date) === 4) {
                    // Tahun (YYYY)
                    $query->whereYear('created_at', $carbonDate->year);
                    $statsQuery->whereYear('created_at', $carbonDate->year);
                } elseif (strlen($date) === 7) {
                    // Bulan & Tahun (YYYY-MM)
                    $query->whereYear('created_at', $carbonDate->year)
                        ->whereMonth('created_at', $carbonDate->month);
                    $statsQuery->whereYear('created_at', $carbonDate->year)
                        ->whereMonth('created_at', $carbonDate->month);
                } elseif (strlen($date) === 10) {
                    // Hari, Bulan, Tahun (YYYY-MM-DD)
                    $query->whereDate('created_at', $carbonDate->toDateString());
                    $statsQuery->whereDate('created_at', $carbonDate->toDateString());
                }
            } catch (\Exception $e) {
                // kalau format salah, bisa diabaikan atau kasih notifikasi error
            }
        }

        // Filter by teacher (opsional)
        if (request('teacher')) {
            $teacherId = request('teacher');
            $query->where('absent_teacher_id', $teacherId);
            $statsQuery->where('absent_teacher_id', $teacherId);
        }

        // Jika tidak ada filter tanggal & guru, tampilkan data hari ini (berdasarkan created_at)
        if (!$hasDateFilter && !request('teacher')) {
            $today = Carbon::today()->toDateString();
            $query->whereDate('created_at', $today);
            $statsQuery->whereDate('created_at', $today);
        }

        $absences = $query->paginate(5);

        // Hitung statistik berdasarkan filter yang sama
        $totalAbsences = $statsQuery->count();
        $totalSubstitutions = $statsQuery->clone()->whereNotNull('substitute_teacher_id')->count();
        $uniqueTeachers = $statsQuery->clone()->distinct('absent_teacher_id')->count('absent_teacher_id');

        // Ambil semua teacher
        $teachers = Teacher::all();

        return view('public.absences.index', compact(
            'absences',
            'teachers',
            'totalAbsences',
            'totalSubstitutions',
            'uniqueTeachers'
        ));
    }

    public function show(Absence $absence)
    {
        $absence->load(['absentTeacher', 'substituteTeacher', 'classroom']);

        return view('public.absences.show', compact('absence'));
    }
}