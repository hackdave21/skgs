<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminControllers\AdminController;
use App\Http\Controllers\AdminControllers\ReportController;
use App\Http\Controllers\AdminControllers\SchoolClasseController;
use App\Http\Controllers\AdminControllers\StudentController;
use App\Http\Controllers\AdminControllers\SubjectController;
use App\Http\Controllers\AdminControllers\TeacherController;

use App\Http\Controllers\PlateformControllers\TeacherAuthController;
use App\Http\Controllers\PlateformControllers\NoteController;
use App\Http\Controllers\PlateformControllers\BulletinController;

// Page d'accueil par défaut
Route::get('/', function () {
    return view('welcome');
});

// Routes publiques pour l'authentification admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login')->middleware('guest');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit')->middleware('guest');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout')->middleware('auth');
});

// Routes protégées par le middleware `auth` ou un middleware spécifique `auth.admin`
Route::middleware('auth')->prefix('admin')->group(function () {
    // Routes pour l'administration générale
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Exemple de page dashboard
    })->name('admin.dashboard');

    // Routes pour les rapports
    Route::prefix('reports')->group(function () {
        Route::get('/generate/{classId}', [ReportController::class, 'generate'])->name('admin.reports.generate');
        Route::get('/download/{classId}', [ReportController::class, 'download'])->name('admin.reports.download');
    });

    // Routes pour la gestion des classes
    Route::prefix('classes')->group(function () {
        Route::get('/', [SchoolClasseController::class, 'index'])->name('admin.classes.index');
        Route::get('/create', [SchoolClasseController::class, 'create'])->name('admin.classes.create');
        Route::post('/store', [SchoolClasseController::class, 'store'])->name('admin.classes.store');
        Route::get('/edit/{id}', [SchoolClasseController::class, 'edit'])->name('admin.classes.edit');
        Route::post('/update/{id}', [SchoolClasseController::class, 'update'])->name('admin.classes.update');
        Route::post('/delete/{id}', [SchoolClasseController::class, 'destroy'])->name('admin.classes.delete');
    });

    // Routes pour la gestion des étudiants
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('admin.students.index');
        Route::get('/create', [StudentController::class, 'create'])->name('admin.students.create');
        Route::post('/store', [StudentController::class, 'store'])->name('admin.students.store');
        Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('admin.students.edit');
        Route::post('/update/{id}', [StudentController::class, 'update'])->name('admin.students.update');
        Route::post('/delete/{id}', [StudentController::class, 'destroy'])->name('admin.students.delete');
    });

    // Routes pour la gestion des matières
    Route::prefix('subjects')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('admin.subjects.index');
        Route::get('/create', [SubjectController::class, 'create'])->name('admin.subjects.create');
        Route::post('/store', [SubjectController::class, 'store'])->name('admin.subjects.store');
        Route::get('/edit/{id}', [SubjectController::class, 'edit'])->name('admin.subjects.edit');
        Route::post('/update/{id}', [SubjectController::class, 'update'])->name('admin.subjects.update');
        Route::post('/delete/{id}', [SubjectController::class, 'destroy'])->name('admin.subjects.delete');
    });

    // Routes pour la gestion des enseignants
    Route::prefix('teachers')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');
        Route::get('/create', [TeacherController::class, 'create'])->name('admin.teachers.create');
        Route::post('/store', [TeacherController::class, 'store'])->name('admin.teachers.store');
        Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
        Route::post('/update/{id}', [TeacherController::class, 'update'])->name('admin.teachers.update');
        Route::post('/delete/{id}', [TeacherController::class, 'destroy'])->name('admin.teachers.delete');
    });
});


// Routes pour l'authentification des enseignants
Route::prefix('teacher')->group(function () {
    Route::get('/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');
    Route::post('/login', [TeacherAuthController::class, 'login'])->name('teacher.login.submit');
    Route::post('/logout', [TeacherAuthController::class, 'logout'])->name('teacher.logout');
});

// Routes pour la gestion des notes
Route::prefix('notes')->group(function () {
    Route::get('/{SchoolClassId}/{subjectId}', [NoteController::class, 'showForm'])->name('notes.form');
    Route::post('/{SchoolClassId}/{subjectId}', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/{SchoolClassId}/{subjectId}/{studentId}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::put('/{SchoolClassId}/{subjectId}/{studentId}', [NoteController::class, 'update'])->name('notes.update');
});

// Routes pour la gestion des bulletins
Route::prefix('bulletins')->group(function () {
    Route::get('/{SchoolClassId}', [BulletinController::class, 'index'])->name('bulletins.index');
    Route::get('/{studentId}', [BulletinController::class, 'show'])->name('bulletins.show');
    Route::get('/{studentId}/generate', [BulletinController::class, 'generateReport'])->name('bulletins.generate');
});
