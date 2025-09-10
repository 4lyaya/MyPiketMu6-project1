<?php

namespace App\Exports;

use App\Models\Absence;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsencesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])
            ->get()
            ->map(function ($a) {
                return [
                    'ID' => $a->id,
                    'Guru Absen' => $a->absentTeacher->name ?? '-',
                    'Guru Pengganti' => $a->substituteTeacher->name ?? '-',
                    'Kelas' => $a->classroom->name ?? '-',
                    'Tgl Digantikan' => \Carbon\Carbon::parse($a->replaced_at)->format('d/m/Y'),
                    'Jam' => implode(', ', $a->getSelectedPeriods()),
                    'Alasan' => ucfirst($a->reason),
                    'Catatan' => $a->note ?: '-',
                    'Dibuat' => $a->created_at->format('d/m/Y H:i'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Guru Absen',
            'Guru Pengganti',
            'Kelas',
            'Tgl Digantikan',
            'Jam Pelajaran',
            'Alasan',
            'Catatan',
            'Dibuat'
        ];
    }
}