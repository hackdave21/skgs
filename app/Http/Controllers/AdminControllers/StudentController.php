<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasse;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $school_classes = SchoolClasse::with('students')->get();
        return view('admin.students.index', compact('school_classes'));
    }

    public function create()
    {
        $school_classes = SchoolClasse::all();
        return view('admin.students.create', compact('school_classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'matricule_number' => 'required|string|unique:students',
            'school_classe_id' => 'required|exists:school_classes,id',
        ]);

        Student::create($request->only('first_name', 'last_name', 'matricule_number', 'school_classe_id'));

        return redirect()->route('admin.students.index')->with('success', 'Elève enregistré(e) avec succès');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $school_classes = SchoolClasse::all();
        return view('admin.students.edit', compact('student', 'school_classes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'matricule_number' => 'required|string|unique:students,matricule_number,' . $id,
            'school_classe_id' => 'required|exists:school_classes,id',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->only('first_name', 'last_name', 'matricule_number', 'school_classe_id'));

        return redirect()->route('admin.students.index')->with('success', 'Elève mis à jour avec succès');
    }

    public function delete($id)
    {
        Student::findOrFail($id)->delete();
        return redirect()->route('admin.students.index')->with('success', 'Elève supprimé avec succès');
    }
}
