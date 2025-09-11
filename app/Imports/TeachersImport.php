<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Teacher([
            'name' => $row['nama'] ?? $row['name'] ?? null,
            'phone' => $row['telepon'] ?? $row['phone'] ?? null,
        ]);
    }
}