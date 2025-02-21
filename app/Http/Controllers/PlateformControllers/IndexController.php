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

    public function show($id)
    {
        $user = Auth::user();
        $schoolClasse = $user->schoolClasses()
        ->with(['students' => function($query) {
            $query->orderBy('last_name')
                  ->orderBy('first_name');
        }])
        ->findOrFail($id);

    return view('frontend.show', compact('schoolClasse'));
    }
}
