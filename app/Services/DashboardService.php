<?php

namespace App\Services;

use App\Models\Absence;
use App\Models\Teacher;
use App\Models\Classroom;

class DashboardService
{
    public function getGuruStats(int $teacherId): array
    {
        $teacher = Teacher::where('user_id', $teacherId)->first();

        if (!$teacher) {
            return [
                'total_teachers'      => 0,
                'total_absences'      => 0,
                'total_substitutions' => 0,
                'total_classes'       => 0,
                'latest_notes'        => [],
            ];
        }

        return [
            'total_teachers'      => Teacher::count(),
            'total_absences'      => Absence::where('absent_teacher_id', $teacher->id)->count(),
            'total_substitutions' => Absence::where('substitute_teacher_id', $teacher->id)->count(),
            'total_classes'       => Absence::where('absent_teacher_id', $teacher->id)
                ->distinct('classroom_id')
                ->count('classroom_id'),
            'latest_notes'        => Absence::where('absent_teacher_id', $teacher->id)
                ->whereNotNull('note')
                ->latest('replaced_at')
                ->limit(5)
                ->pluck('note')
                ->toArray(),
        ];
    }

    public function getAdminStats(): array
    {
        return [
            'total_teachers'      => Teacher::count(),
            'total_absences'      => Absence::count(),
            'total_substitutions' => Absence::whereNotNull('substitute_teacher_id')->count(),
            'total_classes'       => Classroom::count(),
        ];
    }
}
