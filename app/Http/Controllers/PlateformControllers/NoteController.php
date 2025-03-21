<?php

namespace App\Http\Controllers\PlateformControllers;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\SchoolClasse;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class NoteController extends Controller
{
       /**
     * Affiche le formulaire pour saisir les notes d'un élève.
     */
    public function showForm($schoolClassId, $subjectId)
    {
        $schoolClass = SchoolClasse::findOrFail($schoolClassId);
        $subject = Subject::findOrFail($subjectId);
        $students = Student::where('class_id', $schoolClassId)->get();

        // Récupérer les notes existantes pour cette matière et cette classe
        $grades = Grade::where('school_classe_id', $schoolClassId)
                       ->where('subject_id', $subjectId)
                       ->get()
                       ->keyBy('student_id'); // Organiser par student_id

        // Retourner une réponse JSON pour l'AJAX
        if (request()->expectsJson()) {
            return response()->json([
                'schoolClass' => $schoolClass,
                'subject' => $subject,
                'students' => $students,
                'grades' => $grades
            ]);
        }

        // Retourner la vue si ce n'est pas une requête AJAX
        return view('frontend.notes', compact('schoolClass', 'subject', 'students', 'grades'));
    }

    /**
     * Enregistre  les notes d'un élève pour une matière.
     */
    public function store(Request $request)
    {
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'notes' => 'required|array',
            'notes.*' => 'numeric|min:0|max:20',
        ]);

        $schoolClassId = $request->school_class_id;
        $subjectId = $request->subject_id;

        foreach ($request->notes as $studentId => $note) {
            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'school_classe_id' => $schoolClassId,
                    'subject_id' => $subjectId,
                ],
                ['value' => $note]
            );
        }

        return response()->json(['success' => true, 'message' => 'Notes enregistrées avec succès']);
    }
    
    public function getSubjects($schoolClassId, $studentId)
    {
        try {
            $student = Student::findOrFail($studentId);
            $schoolClass = SchoolClasse::findOrFail($schoolClassId);
            $subjects = Subject::all();
            $student->load(['subjects' => function($query) {
                $query->withPivot('note');
            }]);

            // Associer les notes aux matières
            $subjectsWithNotes = $subjects->map(function($subject) use ($student) {
                $existingNote = $student->subjects->firstWhere('id', $subject->id);
                $subject->studentNotes = $existingNote ? [$existingNote] : [];
                return $subject;
            });

            return response()->json([
                'student' => $student,
                'subjects' => $subjectsWithNotes
            ]);
        } catch (\Exception $e) {
            // Ajout d'un log pour mieux déboguer
            // \Log::error('Erreur dans getSubjects: ' . $e->getMessage());
            return response()->json(['error' => 'Une erreur est survenue : ' . $e->getMessage()], 500);
        }
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

        return back()->with('success', 'Notes mis à jour avec succès');
    }
}
