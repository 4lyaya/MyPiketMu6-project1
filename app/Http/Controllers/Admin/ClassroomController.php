<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    /**
     * Tampilkan semua kelas
     */
    public function index()
    {
        $classrooms = Classroom::latest()->paginate(10);
        return view('admin.classrooms.index', compact('classrooms'));
    }

    /**
     * Form tambah kelas
     */
    public function create()
    {
        return view('admin.classrooms.create');
    }

    /**
     * Simpan kelas baru
     */
    public function store(StoreClassroomRequest $request)
    {
        Classroom::create($request->validated());

        return redirect()->route('admin.classrooms.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Detail kelas
     */
    public function show(Classroom $classroom)
    {
        return view('admin.classrooms.show', compact('classroom'));
    }

    /**
     * Form edit kelas
     */
    public function edit(Classroom $classroom)
    {
        return view('admin.classrooms.edit', compact('classroom'));
    }

    /**
     * Update data kelas
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->validated());

        return redirect()->route('admin.classrooms.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Hapus kelas
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return redirect()->route('admin.classrooms.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
