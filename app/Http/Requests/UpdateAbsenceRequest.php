<?php

namespace App\Http\Requests;

use App\Helpers\PeriodHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAbsenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return in_array($this->user()?->role, ['admin', 'guru']);
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'periods_mask' => PeriodHelper::periodsToMask($this->input('periods', [])),
        ]);
    }

    public function rules(): array
    {
        return [
            'absent_teacher_id' => 'required|exists:teachers,id',
            'substitute_teacher_id' => 'nullable|exists:teachers,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'replaced_at' => 'required|date',
            'periods_mask' => 'required|integer|min:1|max:1023',
            'reason' => 'required|in:sakit,alpha,izin,terlambat,tugas_sekolah',
            'note' => 'nullable|string',
        ];
    }
}
