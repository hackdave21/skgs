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

    // public function show($id)
    // {
    //     $user = Auth::user();
    //     $schoolClasse = $user->schoolClasses()
    //     ->with(['students' => function($query) {
    //         $query->orderBy('last_name')
    //               ->orderBy('first_name');
    //     }])
    //     ->findOrFail($id);

    // return view('frontend.show', compact('schoolClasse'));
    // }
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

    public function getStudents(Request $request)
{
    $teacher = Auth::user();
    $schoolClassId = $request->query('school_class_id');
    $subjectId = $request->query('subject_id');

    if (!$schoolClassId || !$subjectId) {
        return response()->json(['error' => 'Classe ou matière non spécifiée'], 400);
    }

    // Vérifier si l'enseignant enseigne bien cette matière dans cette classe
    $schoolClass = $teacher->schoolClasses()->find($schoolClassId);
    if (!$schoolClass) {
        return response()->json(['error' => 'Classe non trouvée ou non autorisée'], 403);
    }

    $isTeachingSubject = $teacher->subjects()
        ->wherePivot('school_classe_id', $schoolClassId)
        ->where('subjects.id', $subjectId)
        ->exists();

    if (!$isTeachingSubject) {
        return response()->json(['error' => 'Vous n\'enseignez pas cette matière dans cette classe'], 403);
    }

    // Récupérer les élèves de cette classe
    $students = Student::where('school_classe_id', $schoolClassId)->get();

    return response()->json(['students' => $students]);
}

}
