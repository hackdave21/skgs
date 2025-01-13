<?php

namespace App\Http\Controllers\PlateformControllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasse;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class NoteController extends Controller
{
       /**
     * Affiche le formulaire pour saisir les notes d'un élève.
     */
    public function showForm($SchoolClassId, $subjectId)
    {
        $class = SchoolClasse::findOrFail($SchoolClassId);
        $subject = Subject::findOrFail($subjectId);
        $students = Student::where('class_id', $SchoolClassId)->get();

        return view('platform.notes.form', compact('class', 'subject', 'students'));
    }

    /**
     * Enregistre ou met à jour les notes d'un élève pour une matière.
     */
    public function store(Request $request, $SchoolClassId, $subjectId)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'note' => 'required|numeric|min:0|max:20',
        ]);

        $student = Student::findOrFail($request->student_id);
        $subject = Subject::findOrFail($subjectId);

        // Logique d'enregistrement ou de mise à jour des notes
        $student->subjects()->updateExistingPivot($subject->id, ['note' => $request->note]);

        return back()->with('success', 'Note saved successfully.');
    }

    /**
     * Affiche le formulaire de modification des notes d'un élève.
     */
    public function edit($SchoolClassId, $subjectId, $studentId)
    {
        $school_class = SchoolClasse::findOrFail($SchoolClassId);
        $subject = Subject::findOrFail($subjectId);
        $student = Student::findOrFail($studentId);

        return view('platform.notes.edit', compact('class', 'subject', 'student'));
    }

    /**
     * Met à jour les notes d'un élève pour une matière.
     */
    public function update(Request $request, $SchoolClassId, $subjectId, $studentId)
    {
        $request->validate([
            'note' => 'required|numeric|min:0|max:20',
        ]);

        $student = Student::findOrFail($studentId);
        $subject = Subject::findOrFail($subjectId);

        // Mise à jour des notes
        $student->subjects()->updateExistingPivot($subject->id, ['note' => $request->note]);

        return back()->with('success', 'Note updated successfully.');
    }
}
