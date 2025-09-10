<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FullBackupExport implements WithMultipleSheets
{
    protected $teachers, $classrooms, $absences;

    public function __construct($teachers, $classrooms, $absences)
    {
        $this->teachers = $teachers;
        $this->classrooms = $classrooms;
        $this->absences = $absences;
    }

    public function sheets(): array
    {
        return [
            'Guru' => new TeachersExport($this->teachers),
            'Kelas' => new ClassroomsExport($this->classrooms),
            'Absensi' => new AbsencesExport($this->absences),
        ];
    }
}