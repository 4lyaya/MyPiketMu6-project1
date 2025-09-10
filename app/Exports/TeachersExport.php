<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeachersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Teacher::select('id', 'name', 'phone', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama', 'Telepon', 'Dibuat'];
    }
}