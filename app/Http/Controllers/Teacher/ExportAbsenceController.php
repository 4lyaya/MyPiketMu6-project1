<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Mpdf\Mpdf;
use App\Exports\TeacherAbsenceExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportAbsenceController extends Controller
{
    public function form()
    {
        $teachers = Teacher::orderBy('name')->get();
        return view('teacher.exports.form', compact('teachers'));
    }

    public function export(Request $request)
    {
        $request->validate([
            'teacher_id' => 'nullable|exists:teachers,id',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'output' => 'required|in:html,pdf,xlsx',
        ]);

        // Default jika kosong
        $teacher = $request->teacher_id ? Teacher::find($request->teacher_id) : null;
        $start = $request->start_date ? Carbon::parse($request->start_date)->startOfDay() : null;
        $end = $request->end_date ? Carbon::parse($request->end_date)->endOfDay() : null;

        // Query dasar
        $query = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])
            ->latest('created_at');

        // 1. Jika hanya memilih guru (tanpa tanggal)
        if ($teacher && !$start && !$end) {
            $query->where(function ($q) use ($teacher) {
                $q->where('absent_teacher_id', $teacher->id)
                    ->orWhere('substitute_teacher_id', $teacher->id);
            });
        }

        // 2. Jika hanya mengisi tanggal (tanpa guru)
        elseif (!$teacher && $start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }

        // 3. Jika keduanya diisi
        elseif ($teacher && $start && $end) {
            $query->where(function ($q) use ($teacher) {
                $q->where('absent_teacher_id', $teacher->id)
                    ->orWhere('substitute_teacher_id', $teacher->id);
            })->whereBetween('created_at', [$start, $end]);
        }

        // 4. Jika keduanya kosong → default hari ini
        else {
            $query->whereDate('created_at', Carbon::today());
            $start = Carbon::today();
            $end = Carbon::today();
        }

        $absences = $query->get();
        $output = $request->output;

        switch ($output) {
            case 'html':
                return view('teacher.exports.preview', compact('teacher', 'absences', 'start', 'end'));

            case 'xlsx':
                $fileName = 'absensi' .
                    ($teacher ? '-' . $teacher->name : '') .
                    ($start ? '-' . $start->format('Ymd') : '') .
                    ($end ? '-' . $end->format('Ymd') : '') .
                    '.xlsx';
                return Excel::download(new TeacherAbsenceExport($absences), $fileName);

            case 'pdf':
            default:
                $html = view('teacher.exports.pdf', compact('teacher', 'absences', 'start', 'end'))->render();
                $mpdf = new Mpdf(['orientation' => 'P']);
                $mpdf->WriteHTML($html);

                $fileName = 'absensi' .
                    ($teacher ? '-' . $teacher->name : '') .
                    ($start ? '-' . $start->format('Ymd') : '') .
                    ($end ? '-' . $end->format('Ymd') : '') .
                    '.pdf';

                return $mpdf->Output($fileName, 'D');
        }
    }
}