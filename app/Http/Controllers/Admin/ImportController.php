<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\TeachersImport;
use App\Imports\ClassroomsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
    {
        return view('admin.import.index');
    }

    public function importTeachers(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv']);
        Excel::import(new TeachersImport, $request->file('file'));
        return back()->with('success', 'Data guru berhasil diimport!');
    }

    public function importClassrooms(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv']);
        Excel::import(new ClassroomsImport, $request->file('file'));
        return back()->with('success', 'Data kelas berhasil diimport!');
    }
}