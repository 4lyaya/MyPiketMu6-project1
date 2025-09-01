<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'phone',
    ];

    public function absencesAsAbsent()
    {
        return $this->hasMany(Absence::class, 'absent_teacher_id');
    }

    public function absencesAsSubstitute()
    {
        return $this->hasMany(Absence::class, 'substitute_teacher_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'absent_teacher_id');
    }

    public function substitutions()
    {
        return $this->hasMany(Absence::class, 'substitute_teacher_id');
    }
}
