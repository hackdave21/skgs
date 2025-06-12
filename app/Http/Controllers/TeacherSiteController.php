<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\SchoolClasse;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherSiteController extends Controller
{
    public function classStudents(SchoolClasse $class, Subject $subject)
    {
        // Récupérer les étudiants avec leurs notes pour cette matière et cette classe
        $students = $class->students()
            ->with(['grades' => function($query) use ($subject, $class) {
                $query->where('subject_id', $subject->id)
                      ->where('school_classe_id', $class->id)
                      ->with('user');
            }])
            ->orderBy('last_name')
            ->get();

        return view('frontend.class_students', [
            'class' => $class,
            'subject' => $subject,
            'students' => $students
        ]);
    }

    public function storeGrade(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'school_classe_id' => 'required|exists:school_classes,id',
            'note_type' => 'required|in:note1,note2,devoir,compos',
            'note_value' => 'required|numeric|min:0|max:20'
        ]);

        // Vérifier si une ligne de notes existe déjà pour cet étudiant dans cette matière/classe
        $grade = Grade::firstOrCreate(
            [
                'student_id' => $request->student_id,
                'subject_id' => $request->subject_id,
                'school_classe_id' => $request->school_classe_id,
            ],
            [
                'user_id' => $request->user()->id,
            ]
        );

        // Mettre à jour le type de note spécifique
        $grade->{$request->note_type} = $request->note_value;
        $grade->save();

        return back()->with('success', 'Note ajoutée avec succès !');
    }

    public function updateGrade(Request $request, Grade $grade)
    {
        $request->validate([
            'note_type' => 'required|in:note1,note2,devoir,compos',
            'note_value' => 'nullable|numeric|min:0|max:20'
        ]);

        $grade->{$request->note_type} = $request->note_value;
        $grade->save();

        return back()->with('success', 'Note modifiée avec succès !');
    }

    public function deleteGrade($gradeId)
    {
        $grade = Grade::findOrFail($gradeId);
        $grade->delete();

        return back()->with('success', 'Notes supprimées avec succès !');
    }

    public function deleteSpecificGrade(Request $request, Grade $grade)
    {
        $request->validate([
            'note_type' => 'required|in:note1,note2,devoir,compos'
        ]);

        $grade->{$request->note_type} = null;

        // Si toutes les notes sont null, supprimer l'enregistrement
        if (is_null($grade->note1) && is_null($grade->note2) &&
            is_null($grade->devoir) && is_null($grade->compos)) {
            $grade->delete();
        } else {
            $grade->save();
        }

        return back()->with('success', 'Note supprimée avec succès !');
    }
}
