<?php

namespace App\Services;

use App\Models\Absence;
use App\Models\Teacher;

class DashboardService
{
    public function getGuruStats(int $teacherId): array
    {
        $teacher = Teacher::find($teacherId);

        if (!$teacher) {
            return [];
        }

        $totalAbsences = $teacher->absences()->count();
        $totalSubstitutions = $teacher->substitutions()->count();
        $totalClasses = $teacher->absences()->distinct('classroom_id')->count('classroom_id');

        $latestNotes = $teacher->absences()
            ->latest('replaced_at')
            ->limit(5)
            ->pluck('note')
            ->filter()
            ->toArray();

        return [
            'total_absences' => $totalAbsences,
            'total_substitutions' => $totalSubstitutions,
            'total_classes' => $totalClasses,
            'latest_notes' => $latestNotes,
        ];
    }

    public function getAdminStats(): array
    {
        $totalTeachers = \App\Models\Teacher::count();
        $totalAbsences = \App\Models\Absence::count();
        $totalSubstitutions = \App\Models\Absence::whereNotNull('substitute_teacher_id')->count();
        $totalClasses = \App\Models\Classroom::count();

        return [
            'total_teachers' => $totalTeachers,
            'total_absences' => $totalAbsences,
            'total_substitutions' => $totalSubstitutions,
            'total_classes' => $totalClasses,
        ];
    }
}
