<?php

namespace App\Imports;

use App\Models\Classroom;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClassroomsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Classroom([
            'name' => $row['nama_kelas'] ?? $row['name'] ?? null,
        ]);
    }
}