<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;

class TeacherController extends Controller
{
    /**
     * Tampilkan semua guru
     */
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Form tambah guru
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Simpan guru baru
     */
    public function store(StoreTeacherRequest $request)
    {
        Teacher::create($request->validated());

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Guru berhasil ditambahkan.');
    }

    /**
     * Detail guru
     */
    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Form edit guru
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update data guru
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Hapus guru
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Guru berhasil dihapus.');
    }
}
