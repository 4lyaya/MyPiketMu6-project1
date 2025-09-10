<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class TeacherAbsenceExport implements FromView, WithTitle
{
    protected $absences;

    public function __construct($absences)
    {
        $this->absences = $absences;
    }

    public function view(): View
    {
        return view('teacher.exports.excel', [
            'absences' => $this->absences
        ]);
    }

    public function title(): string
    {
        return 'Absensi Guru';
    }
}