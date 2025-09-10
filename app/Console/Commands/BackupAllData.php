<?php

namespace App\Console\Commands;

use App\Exports\TeachersExport;
use App\Exports\ClassroomsExport;
use App\Exports\AbsencesExport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class BackupAllData extends Command
{
    protected $signature = 'backup:all {type=excel} {--pdf}';
    protected $description = 'Backup semua tabel ke Excel/PDF';

    public function handle()
    {
        $type = $this->argument('type');
        $pdf = $this->option('pdf');

        if ($pdf || $type === 'pdf') {
            $this->backupPdf();
        } else {
            Excel::store(new TeachersExport(), 'backups/teachers.xlsx', 'local');
            Excel::store(new ClassroomsExport(), 'backups/classrooms.xlsx', 'local');
            Excel::store(new AbsencesExport(), 'backups/absences.xlsx', 'local');
            $this->info('Backup Excel selesai → storage/app/backups/');
        }
    }

    private function backupPdf()
    {
        $mpdf = new Mpdf(['orientation' => 'P']);
        $mpdf->WriteHTML(view('exports.pdf.all')->render());
        $mpdf->Output(storage_path('app/backups/full-backup.pdf'), 'F');
        $this->info('Backup PDF selesai → storage/app/backups/full-backup.pdf');
    }
}