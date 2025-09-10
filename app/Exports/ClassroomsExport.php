<?php

namespace App\Exports;

use App\Models\Classroom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassroomsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Classroom::select('id', 'name', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama Kelas', 'Dibuak'];
    }
}