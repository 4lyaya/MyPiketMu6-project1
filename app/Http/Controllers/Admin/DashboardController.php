<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ---------- Searching & Filter ----------
        $search       = $request->input('search');
        $filterDate   = $request->input('date'); // YYYY / YYYY-MM / YYYY-MM-DD
        $filterReason = $request->input('reason');

        // Query dasar (3 terbaru di atas nanti)
        $query = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])
            ->latest('created_at');

        // Filter tanggal (tahun/bulan/hari)
        if ($filterDate) {
            try {
                $carbonDate = Carbon::parse($filterDate);
                if (strlen($filterDate) === 4) {                // Tahun
                    $query->whereYear('created_at', $carbonDate->year);
                } elseif (strlen($filterDate) === 7) {          // Bulan
                    $query->whereYear('created_at', $carbonDate->year)
                        ->whereMonth('created_at', $carbonDate->month);
                } elseif (strlen($filterDate) === 10) {         // Hari
                    $query->whereDate('created_at', $carbonDate->toDateString());
                }
            } catch (\Exception $e) {
                // invalid date → abaikan
            }
        } else {
            // Default: hari ini
            $query->whereDate('created_at', Carbon::today()->toDateString());
        }

        // Searching (nama guru absen / pengganti)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('absentTeacher', fn($q) => $q->where('name', 'like', "%$search%"))
                    ->orWhereHas('substituteTeacher', fn($q) => $q->where('name', 'like', "%$search%"));
            });
        }

        // Filter alasan
        if ($filterReason) {
            $query->where('reason', $filterReason);
        }

        // ---------- 3 Data Terbaru (di atas) ----------
        $latestAbsences = (clone $query)->take(3)->get();

        // ---------- Data Paginasi (setelah 3 terbaru) ----------
        $absences = $query->paginate(3);

        // ---------- Stat-Card ----------
        $stats = [
            'total_guru'            => Teacher::count(),
            'guru_absen'            => (clone $query)->distinct('absent_teacher_id')->count('absent_teacher_id'),
            'guru_menggantikan'     => (clone $query)->distinct('substitute_teacher_id')->count('substitute_teacher_id'),
            'total_kelas'           => Classroom::count(),
            'total_user'            => User::count(),
        ];

        // ---------- Info Login ----------
        $user = auth()->user();

        return view('admin.dashboard', compact(
            'latestAbsences',
            'absences',
            'stats',
            'user',
            'search',
            'filterDate',
            'filterReason'
        ));
    }
}
