<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAbsenceRequest;
use App\Http\Requests\UpdateAbsenceRequest;
use App\Models\Absence;
use App\Models\Teacher;
use App\Models\Classroom;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with(['absentTeacher', 'substituteTeacher', 'classroom'])
            ->latest()->paginate(10);

        return view('teacher.absences.index', compact('absences'));
    }

    public function create()
    {
        $teachers = Teacher::all();
        $classrooms = Classroom::all();

        return view('teacher.absences.create', compact('teachers', 'classrooms'));
    }

    public function store(StoreAbsenceRequest $request)
    {
        Absence::create($request->validated());

        return redirect()->route('guru.absences.index')
            ->with('success', 'Absensi berhasil ditambahkan.');
    }

    public function show(Absence $absence)
    {
        return view('teacher.absences.show', compact('absence'));
    }

    public function edit(Absence $absence)
    {
        $teachers = Teacher::all();
        $classrooms = Classroom::all();

        return view('teacher.absences.edit', compact('absence', 'teachers', 'classrooms'));
    }

    public function update(UpdateAbsenceRequest $request, Absence $absence)
    {
        $absence->update($request->validated());

        return redirect()->route('guru.absences.index')
            ->with('success', 'Absensi berhasil diperbarui.');
    }

    public function destroy()
    {
        abort(403, 'Guru tidak diizinkan menghapus absensi.');
    }
}
