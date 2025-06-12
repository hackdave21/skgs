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
            'note' => 'required|numeric|min:0|max:20'
        ]);


        Grade::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'school_classe_id' => $request->school_classe_id,
            'note' => $request->note
        ]);

        return back()->with('success', 'Note ajoutée avec succès !');
    }

    public function deleteGrade($gradeId)
    {
        $grade = Grade::findOrFail($gradeId);

        $grade->delete();

        return back()->with('success', 'Note supprimée avec succès !');
    }
}
