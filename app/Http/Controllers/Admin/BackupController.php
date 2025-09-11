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
use ZipArchive;

class BackupController extends Controller
{
    /* ---------- FULL BACKUP (ZIP) ---------- */
    public function full(Request $request, $type)
    {
        $teachers = Teacher::with('user')->latest()->get();
        $classrooms = Classroom::latest()->get();
        $absences = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])->latest()->get();

        $zip = new ZipArchive;
        $zipName = 'full-backup-' . now()->format('YmdHis') . '.zip';
        $zipPath = storage_path('app/backups/' . $zipName);

        if ($zip->open($zipPath, ZipArchive::CREATE) !== TRUE) {
            return back()->with('error', 'Gagal membuat file ZIP.');
        }

        /* ---------- EXCEL ---------- */
        if ($type === 'excel') {
            // 1. Guru
            $excelGuru = Excel::raw(new TeachersExport, \Maatwebsite\Excel\Excel::XLSX);
            $zip->addFromString('teachers.xlsx', $excelGuru);

            // 2. Kelas
            $excelKelas = Excel::raw(new ClassroomsExport, \Maatwebsite\Excel\Excel::XLSX);
            $zip->addFromString('classrooms.xlsx', $excelKelas);

            // 3. Absensi
            $excelAbsen = Excel::raw(new AbsencesExport, \Maatwebsite\Excel\Excel::XLSX);
            $zip->addFromString('absences.xlsx', $excelAbsen);
        }

        /* ---------- PDF ---------- */
        if ($type === 'pdf') {
            // 1. Guru
            $pdfGuru = $this->generatePdf('admin.exports.pdf.teachers', ['data' => $teachers]);
            $zip->addFromString('teachers.pdf', $pdfGuru);

            // 2. Kelas
            $pdfKelas = $this->generatePdf('admin.exports.pdf.classrooms', ['data' => $classrooms]);
            $zip->addFromString('classrooms.pdf', $pdfKelas);

            // 3. Absensi
            $pdfAbsen = $this->generatePdf('admin.exports.pdf.absences', ['data' => $absences]);
            $zip->addFromString('absences.pdf', $pdfAbsen);
        }

        $zip->close();

        return response()->download($zipPath, $zipName)->deleteFileAfterSend(true);
    }

    /* ---------- PER TABEL (SINGLE FILE) ---------- */
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

        return Excel::download($export, $table . '-' . now()->format('YmdHis') . '.xlsx');
    }

    /* ---------- HELPER GENERATE PDF ---------- */
    private function generatePdf(string $view, array $data): string
    {
        $html = view($view, $data)->render();
        $mpdf = new Mpdf(['orientation' => 'P']);
        $mpdf->WriteHTML($html);
        return $mpdf->Output('', 'S'); // Return as string
    }
}