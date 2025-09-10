<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\TeachersExport;
use App\Exports\ClassroomsExport;
use App\Exports\AbsencesExport;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Absence;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class BackupController extends Controller
{
    /* ---------- FULL BACKUP ---------- */
    public function full(Request $request, $type)
    {
        $teachers = Teacher::with('user')->latest()->get();
        $classrooms = Classroom::latest()->get();
        $absences = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])->latest()->get();

        if ($type === 'excel') {
            // Zip-like: satu file Excel dengan 3 sheet
            return Excel::download(new \App\Exports\FullBackupExport($teachers, $classrooms, $absences), 'full-backup-' . now()->format('YmdHis') . '.xlsx');
        }

        if ($type === 'pdf') {
            $html = view('exports.pdf.full-backup', compact('teachers', 'classrooms', 'absences'))->render();
            $mpdf = new Mpdf(['orientation' => 'P']);
            $mpdf->WriteHTML($html);
            return $mpdf->Output('full-backup-' . now()->format('YmdHis') . '.pdf', 'D');
        }

        return back()->with('error', 'Tipe backup tidak dikenal.');
    }

    /* ---------- PER TABEL ---------- */
    public function partial(Request $request, $table, $type)
    {
        $export = match ($table) {
            'teachers' => new TeachersExport,
            'classrooms' => new ClassroomsExport,
            'absences' => new AbsencesExport,
            default => null
        };

        if (!$export || $type !== 'excel') {
            return back()->with('error', 'Tabel / tipe tidak valid.');
        }

        $fileName = $table . '-' . now()->format('YmdHis') . '.xlsx';
        return Excel::download($export, $fileName);
    }
}