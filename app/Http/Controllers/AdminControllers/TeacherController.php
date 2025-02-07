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
        $users = User::with(['subjects', 'schoolClasses'])->get();
        $subjects = Subject::all();
        $schoolClasses = SchoolClasse::all();
        return view('admin.teachers.index', compact('users','subjects', 'schoolClasses'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $schoolClasses = SchoolClasse::all();
        return view('admin.teachers.create', compact('subjects', 'schoolClasses'));
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
            'subject_ids' => 'required|array|min:1',
            'subject_ids.*' => 'exists:subjects,id',
            'school_classe_ids' => 'required|array|min:1',
            'school_classe_ids.*' => 'exists:school_classes,id',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'sex' => $request->sex,
            'diplome' => $request->diplome,
            'password' => bcrypt($request->password),
        ]);

        $user->subjects()->attach($request->subject_ids);
        $user->schoolClasses()->attach($request->school_classe_ids);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant ajouté avec succès');
    }

    public function edit($id)
    {
        $users = User::with(['subjects', 'schoolClasses'])->findOrFail($id);
        $subjects = Subject::all();
        $schoolClasses = SchoolClasse::all();
        return view('admin.teachers.edit', compact('users', 'subjects', 'schoolClasses'));
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
            'subject_ids' => 'required|array|min:1',
            'subject_ids.*' => 'exists:subjects,id',
            'school_classe_ids' => 'required|array|min:1',
            'school_classe_ids.*' => 'exists:school_classes,id',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'sex' => $request->sex,
            'diplome' => $request->diplome,
        ]);

        $user->subjects()->sync($request->subject_ids);
        $user->schoolClasses()->sync($request->school_classe_ids);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant modifié avec succès');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        // Détacher toutes les relations avant la suppression
        $user->subjects()->detach();
        $user->schoolClasses()->detach();
        $user->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant supprimé avec succès');
    }
}
