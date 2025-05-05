<?php

namespace App\Http\Controllers\PlateformControllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasse;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
            $teacher = Auth::user();
            $schoolClasses = $teacher->schoolClasses()->withCount('students')->get();

           $teachers_count = User::count();
           $subjects_count = Subject::count();
           $classes_count = SchoolClasse::count();
           $students_count = Student::count();

           return view('frontend.index', compact('teachers_count', 'subjects_count', 'classes_count', 'students_count', 'schoolClasses'));
    }

    public function getTeacherSubjects(Request $request)
    {
        $teacher = Auth::user();
        $schoolClassId = $request->query('school_class_id');

        if (!$schoolClassId) {
            return response()->json(['error' => 'Aucune classe spécifiée'], 400);
        }

        $schoolClass = $teacher->schoolClasses()->find($schoolClassId);
        if (!$schoolClass) {
            return response()->json(['error' => 'Classe non trouvée ou non autorisée'], 403);
        }

        $subjects = $teacher->subjects()
                            ->wherePivot('school_classe_id', $schoolClassId)
                            ->get()
                            ->map(function ($subject) use ($schoolClassId) {
                                return [
                                    'id' => $subject->id,
                                    'name' => $subject->name,
                                    'school_classe_id' => $schoolClassId,
                                ];
                            });

        return response()->json($subjects);
    }

    public function getStudents($schoolClassId, $subjectId)
{
    $teacher = Auth::user();

    // Vérifier si l'enseignant a accès à cette classe et matière
    $schoolClass = $teacher->schoolClasses()->find($schoolClassId);
    if (!$schoolClass) {
        return response()->json(['error' => 'Classe non trouvée ou non autorisée'], 403);
    }

    $subject = $teacher->subjects()->wherePivot('school_classe_id', $schoolClassId)->find($subjectId);
    if (!$subject) {
        return response()->json(['error' => 'Matière non trouvée ou non autorisée'], 403);
    }

    // Récupérer les élèves inscrits dans la classe
    $students = Student::where('school_classe_id', $schoolClassId)->get();

    // Optionnel : Récupérer les notes des élèves si elles existent
    $grades = [];
    foreach ($students as $student) {
        $grades[$student->id] = [
            'value' => $student->grades()->where('subject_id', $subjectId)->value('grade')
        ];
    }

    return response()->json([
        'subject' => ['id' => $subject->id, 'name' => $subject->name],
        'students' => $students,
        'grades' => $grades
    ]);
}


}
