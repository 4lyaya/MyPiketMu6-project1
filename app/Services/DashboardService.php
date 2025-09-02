<?php

namespace App\Services;

use App\Models\Absence;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function getGuruStats(int $teacherId): array
    {
        // Dapatkan teacher berdasarkan user_id
        $teacher = Teacher::where('user_id', $teacherId)->first();

        if (!$teacher) {
            return [
                'total_absences' => 0,
                'total_substitutions' => 0,
                'total_classes' => 0,
                'latest_notes' => []
            ];
        }

        // Hitung total absences yang dibuat oleh guru ini
        $totalAbsences = Absence::where('absent_teacher_id', $teacher->id)->count();

        // Hitung total substitutions dimana guru ini sebagai pengganti
        $totalSubstitutions = Absence::where('substitute_teacher_id', $teacher->id)->count();

        // Hitung total kelas unik dari absences guru ini
        $totalClasses = Absence::where('absent_teacher_id', $teacher->id)
            ->distinct('classroom_id')
            ->count('classroom_id');

        // Ambil catatan terbaru dari absences guru ini
        $latestNotes = Absence::where('absent_teacher_id', $teacher->id)
            ->whereNotNull('note')
            ->latest('replaced_at')
            ->limit(5)
            ->pluck('note')
            ->toArray();

        return [
            'total_absences' => $totalAbsences,
            'total_substitutions' => $totalSubstitutions,
            'total_classes' => $totalClasses,
            'latest_notes' => $latestNotes,
            'teacher_name' => $teacher->name
        ];
    }

    public function getAdminStats(): array
    {
        $totalTeachers = Teacher::count();
        $totalAbsences = Absence::count();
        $totalSubstitutions = Absence::whereNotNull('substitute_teacher_id')->count();
        $totalClasses = Classroom::count();

        return [
            'total_teachers' => $totalTeachers,
            'total_absences' => $totalAbsences,
            'total_substitutions' => $totalSubstitutions,
            'total_classes' => $totalClasses,
        ];
    }
}