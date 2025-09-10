<?php

namespace App\Exports;

use App\Models\Absence;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class AdminAbsenceExport implements FromView, WithTitle
{
    protected $absences;

    public function __construct($absences)
    {
        $this->absences = $absences;
    }

    public function view(): View
    {
        return view('admin.exports.excel', [
            'absences' => $this->absences
        ]);
    }

    public function title(): string
    {
        return 'Absensi Guru';
    }
}