<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminControllers\AdminController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\ReportController;
use App\Http\Controllers\AdminControllers\SchoolClasseController;
use App\Http\Controllers\AdminControllers\StudentController;
use App\Http\Controllers\AdminControllers\SubjectController;
use App\Http\Controllers\AdminControllers\TeacherController;
use App\Http\Controllers\PlateformControllers\TeacherAuthController;
use App\Http\Controllers\PlateformControllers\IndexController as PlateformControllersIndexController;
use App\Http\Controllers\TeacherSiteController;

Route::view('/allclasses', 'frontend.allclasses')->name('all.classes');
Route::prefix('admin')->name('admin.')->group(function () {

    // Page de connexion
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');

    // Routes protégées par middleware auth
    Route::middleware('auth')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});

//gestion de l'enseignant par l'admin

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('teachers')->name('teachers.')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('index');
        Route::get('/create', [TeacherController::class, 'create'])->name('create');
        Route::post('/store', [TeacherController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [TeacherController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [TeacherController::class, 'delete'])->name('delete');
    });
});

//gestion des matieres
Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('subjects')->name('subjects.')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('index');
        Route::get('/create', [SubjectController::class, 'create'])->name('create');
        Route::post('/store', [SubjectController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SubjectController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SubjectController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SubjectController::class, 'delete'])->name('delete');
    });
});

// Routes pour la gestion des classes
Route::prefix('admin')->name('admin.')->group(function () {

    Route::prefix('school_classes')->name('school_classes.')->group(function () {
        Route::get('/', [SchoolClasseController::class, 'index'])->name('index');
        Route::get('/create', [SchoolClasseController::class, 'create'])->name('create');
        Route::post('/store', [SchoolClasseController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SchoolClasseController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [SchoolClasseController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SchoolClasseController::class, 'destroy'])->name('delete');
    });
});


// Routes pour la gestion des eleves
Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [StudentController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [StudentController::class, 'destroy'])->name('delete');
    });
});

// Routes pour l'authentification des enseignants
Route::get('/', function () {
    return redirect()->route('teacher.login');
});
Route::get('/teacher/subjects', [App\Http\Controllers\PlateformControllers\IndexController::class, 'getTeacherSubjects'])->name('teacher.subjects');
Route::get('index', [PlateformControllersIndexController::class, 'index'])->name('index');
Route::get('/notes/{school_class_id}/{subject_id}', [App\Http\Controllers\PlateformControllers\IndexController::class, 'getStudents']);

Route::prefix('teacher')->group(function () {
    Route::get('/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');
    Route::post('/login', [TeacherAuthController::class, 'login'])->name('teacher.login.submit');
    Route::post('/logout', [TeacherAuthController::class, 'logout'])->name('teacher.logout');
});
    // Routes pour la gestion des classes des enseignants
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [PlateformControllersIndexController::class, 'index'])
            ->name('frontend.index');

        Route::prefix('teacher')->name('teacher.')->group(function () {
            Route::get('/students', [PlateformControllersIndexController::class, 'getStudents'])->name('students');
        });
    });

// Pour les enseignants
Route::middleware(['auth'])->group(function () {
    Route::get('/teacher/class/{class}/subject/{subject}/students', [TeacherSiteController::class, 'classStudents'])
         ->name('teacher.class.students');

    // Routes pour la gestion des notes
    Route::post('/teacher/grade/store', [TeacherSiteController::class, 'storeGrade'])
         ->name('teacher.grade.store');

    Route::put('/teacher/grade/{grade}', [TeacherSiteController::class, 'updateGrade'])
         ->name('teacher.grade.update');

    Route::delete('/teacher/grade/{grade}', [TeacherSiteController::class, 'deleteGrade'])
         ->name('teacher.grade.delete');

    Route::delete('/teacher/grade/{grade}/specific', [TeacherSiteController::class, 'deleteSpecificGrade'])
         ->name('teacher.grade.delete-specific');
});
