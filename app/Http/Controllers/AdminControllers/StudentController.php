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
        $students = Student::with('schoolClasse')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classes = SchoolClasse::all();
        return view('admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'school_classe_id' => 'required|exists:school_classes,id',
        ]);

        Student::create($request->only('name', 'email', 'school_classe_id'));

        return redirect()->route('admin.students.index')->with('success', 'Student added successfully');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $school_classes = SchoolClasse::all();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'school_classe_id' => 'required|exists:school_classes,id',
        ]);

        $student = Student::findOrFail($id);
        $student->update($request->only('name', 'email', 'school_classe_id'));

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully');
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully');
    }
}
