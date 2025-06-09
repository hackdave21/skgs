<?php

namespace App\Http\Controllers;

use App\Models\SchoolClasse;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeacherSiteController extends Controller
{
    public function classStudents(SchoolClasse $class, Subject $subject)
    {
        $students = $class->students()->orderBy('last_name')->get();

        return view('frontend.class_students', [
            'class' => $class,
            'subject' => $subject,
            'students' => $students
        ]);
    }
}
