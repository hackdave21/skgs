<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasse;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.teachers.create', compact('users'));
    }

    public function create()
    {
        $subjects = \App\Models\Subject::all();
        $schoolClasses = \App\Models\SchoolClasse::all();
        return view('admin.teachers.create',  compact('subjects', 'schoolClasses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|string',
            'sex' => 'required|in:M,F',
            'diplome' => 'required|string',
            'password' => 'required|min:6',
            'subject_id' => 'required|exists:subjects,id',
            'school_classe_id' => 'required|exists:school_classes,id',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'sex' => $request->sex,
            'diplome' => $request->diplome,
            'password' => bcrypt($request->password),
            'subject_id' => $request->subject_id,
            'school_classe_id' => $request->school_classe_id,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully');
    }

    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        $subjects = Subject::all();
        $schoolClasses = SchoolClasse::all();
        return view('admin.teachers.edit', compact('teacher', 'subjects', 'schoolClasses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'required|string',
            'sex' => 'required|in:M,F',
            'diplome' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
            'school_classe_id' => 'required|exists:school_classes,id',
        ]);

        $teacher = User::findOrFail($id);
        $teacher->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'sex' => $request->sex,
            'diplome' => $request->diplome,
            'subject_id' => $request->subject_id,
            'school_classe_id' => $request->school_classe_id,
        ]);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant modifié avec succès');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant supprimé avec succès');
    }
}
