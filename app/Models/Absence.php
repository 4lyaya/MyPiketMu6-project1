<?php

namespace App\Models;

use App\Helpers\PeriodHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absence extends Model
{
    use HasFactory;

    protected $table = 'absences';

    protected $fillable = [
        'absent_teacher_id',
        'substitute_teacher_id',
        'classroom_id',
        'replaced_at',
        'periods_mask',
        'reason',
        'note',
    ];

    protected $casts = [
        'replaced_at' => 'datetime',
    ];

    public function absentTeacher()
    {
        return $this->belongsTo(Teacher::class, 'absent_teacher_id');
    }

    public function substituteTeacher()
    {
        return $this->belongsTo(Teacher::class, 'substitute_teacher_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    
    public function getSelectedPeriods(): array
    {
        return PeriodHelper::maskToPeriods($this->periods_mask);
    }
}
