<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard khusus untuk guru
     */
    public function index(Request $request)
    {
        // Pastikan hanya guru yang bisa mengakses
        if (!in_array(Auth::user()->role, ['guru', 'admin'])) {
            abort(403, 'Akses ditolak. Hanya untuk role guru atau admin.');
        }

        $currentDate = $request->input('date', Carbon::today()->format('Y-m-d'));
        $selectedDate = Carbon::parse($currentDate);

        // Jika user adalah guru, dapatkan ID guru yang sesuai
        $teacherId = null;
        if (Auth::user()->role === 'guru') {
            // Asumsikan nama guru disimpan di kolom 'name' pada tabel users
            // dan nama guru di tabel teachers disimpan di kolom 'name'
            $userName = Auth::user()->name;
            $teacher = Teacher::where('name', $userName)->first();

            if ($teacher) {
                $teacherId = $teacher->id;
            }
        }

        // Data guru yang tidak masuk pada tanggal tertentu
        $absentTeachers = Absence::with(['absentTeacher', 'classroom'])
            ->whereDate('replaced_at', $selectedDate)
            ->get()
            ->groupBy('absent_teacher_id')
            ->map(function ($absences) {
                return [
                    'teacher' => $absences->first()->absentTeacher,
                    'absences' => $absences,
                    'periods' => $absences->flatMap->getSelectedPeriods()->unique()->sort()
                ];
            });

        // Data guru pengganti pada tanggal tertentu
        $substituteTeachers = Absence::with(['substituteTeacher', 'classroom', 'absentTeacher'])
            ->whereDate('replaced_at', $selectedDate)
            ->get()
            ->groupBy('substitute_teacher_id')
            ->map(function ($absences) {
                return [
                    'teacher' => $absences->first()->substituteTeacher,
                    'absences' => $absences,
                    'periods' => $absences->flatMap->getSelectedPeriods()->unique()->sort()
                ];
            });

        // Data kelas yang digantikan pada tanggal tertentu
        $substitutedClasses = Absence::with(['classroom', 'absentTeacher', 'substituteTeacher'])
            ->whereDate('replaced_at', $selectedDate)
            ->get()
            ->groupBy('classroom_id')
            ->map(function ($absences) {
                return [
                    'classroom' => $absences->first()->classroom,
                    'absences' => $absences,
                    'periods' => $absences->flatMap->getSelectedPeriods()->unique()->sort()
                ];
            });

        // Jika user adalah guru, tampilkan hanya data yang relevan dengan guru tersebut
        if ($teacherId) {
            // Data absensi dimana guru tersebut tidak hadir
            $myAbsences = Absence::with(['classroom', 'substituteTeacher'])
                ->where('absent_teacher_id', $teacherId)
                ->whereDate('replaced_at', $selectedDate)
                ->get();

            // Data dimana guru tersebut menjadi pengganti
            $mySubstitutions = Absence::with(['classroom', 'absentTeacher'])
                ->where('substitute_teacher_id', $teacherId)
                ->whereDate('replaced_at', $selectedDate)
                ->get();
        } else {
            $myAbsences = collect();
            $mySubstitutions = collect();
        }

        // Statistik untuk card dashboard
        $stats = [
            'absent_today' => $absentTeachers->count(),
            'substitute_today' => $substituteTeachers->count(),
            'classes_affected' => $substitutedClasses->count(),
            'my_absences' => $myAbsences->count(),
            'my_substitutions' => $mySubstitutions->count(),
        ];

        return view('teacher.dashboard', compact(
            'absentTeachers',
            'substituteTeachers',
            'substitutedClasses',
            'myAbsences',
            'mySubstitutions',
            'stats',
            'currentDate',
            'selectedDate'
        ));
    }

    /**
     * Menampilkan riwayat absensi
     */
    public function history(Request $request)
    {
        if (!in_array(Auth::user()->role, ['guru', 'admin'])) {
            abort(403, 'Akses ditolak. Hanya untuk role guru atau admin.');
        }

        $teacherId = null;
        if (Auth::user()->role === 'guru') {
            $userName = Auth::user()->name;
            $teacher = Teacher::where('name', $userName)->first();

            if ($teacher) {
                $teacherId = $teacher->id;
            }
        }

        $dateRange = $request->input('date_range');
        $type = $request->input('type', 'all');

        $query = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom']);

        // Filter berdasarkan guru jika user adalah guru
        if ($teacherId) {
            if ($type === 'absence') {
                $query->where('absent_teacher_id', $teacherId);
            } elseif ($type === 'substitution') {
                $query->where('substitute_teacher_id', $teacherId);
            } else {
                $query->where(function ($q) use ($teacherId) {
                    $q->where('absent_teacher_id', $teacherId)
                        ->orWhere('substitute_teacher_id', $teacherId);
                });
            }
        }

        // Filter berdasarkan rentang tanggal jika ada
        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            if (count($dates) === 2) {
                $startDate = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
                $endDate = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();
                $query->whereBetween('replaced_at', [$startDate, $endDate]);
            }
        } else {
            // Default: 30 hari terakhir
            $query->where('replaced_at', '>=', Carbon::today()->subDays(30));
        }

        $absencesHistory = $query->orderBy('replaced_at', 'desc')
            ->paginate(10);

        return view('dashboard.teacher-history', compact('absencesHistory', 'type'));
    }

    /**
     * Menampilkan detail absensi
     */
    public function show($id)
    {
        if (!in_array(Auth::user()->role, ['guru', 'admin'])) {
            abort(403, 'Akses ditolak. Hanya untuk role guru atau admin.');
        }

        $teacherId = null;
        if (Auth::user()->role === 'guru') {
            $userName = Auth::user()->name;
            $teacher = Teacher::where('name', $userName)->first();

            if ($teacher) {
                $teacherId = $teacher->id;
            }
        }

        $absence = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])
            ->where('id', $id)
            ->firstOrFail();

        // Pastikan guru hanya bisa melihat data yang terkait dengan dirinya
        if ($teacherId && $absence->absent_teacher_id !== $teacherId && $absence->substitute_teacher_id !== $teacherId) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk melihat data ini.');
        }

        return view('dashboard.teacher-absence-detail', compact('absence'));
    }
}
