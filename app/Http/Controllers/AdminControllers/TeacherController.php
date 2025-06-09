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
        // CORRECTION: Récupérer les relations avec distinct() pour éviter les doublons
        $users = User::with(['subjects' => function($query) {
            $query->distinct();
        }, 'schoolClasses' => function($query) {
            $query->distinct();
        }])->get();

        $subjects = Subject::all();
        $schoolClasses = SchoolClasse::all();
        return view('admin.teachers.index', compact('users', 'subjects', 'schoolClasses'));
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

        // CORRECTION: Attacher chaque matière avec chaque classe individuellement
        foreach ($request->subject_ids as $subjectId) {
            foreach ($request->school_classe_ids as $schoolClasseId) {
                $user->subjects()->attach($subjectId, [
                    'school_classe_id' => $schoolClasseId
                ]);
            }
        }

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant ajouté avec succès');
    }

    public function edit($id)
    {
        // CORRECTION: Utiliser les relations distinctes pour l'édition aussi
        $users = User::with(['subjects' => function($query) {
            $query->distinct();
        }, 'schoolClasses' => function($query) {
            $query->distinct();
        }])->findOrFail($id);

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

        // D'abord, détacher toutes les relations existantes
        $user->subjects()->detach();

        // Puis attacher les nouvelles relations
        foreach ($request->subject_ids as $subjectId) {
            foreach ($request->school_classe_ids as $schoolClasseId) {
                $user->subjects()->attach($subjectId, ['school_classe_id' => $schoolClasseId]);
            }
        }

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant modifié avec succès');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        // Détacher toutes les relations avant la suppression
        $user->subjects()->detach();
        // Pas besoin de détacher schoolClasses car c'est la même table pivot
        $user->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant supprimé avec succès');
    }
}
