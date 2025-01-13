<?php

namespace App\Http\Controllers\PlateformControllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasse;
use App\Models\Student;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
     /**
     * Affiche les bulletins d'une classe pour validation.
     *
     * @param int $SchoolClassId
     * @return \Illuminate\View\View
     */
    public function index($SchoolClassId)
    {
        // Récupération de la classe et des élèves associés
        $school_class = SchoolClasse::findOrFail($SchoolClassId);
        $students = Student::where('school_classe_id', $SchoolClassId)->with('subjects')->get();

        // Affichage de la vue pour valider les bulletins
        return view('platform.bulletins.index', compact('class', 'students'));
    }

    /**
     * Génère et affiche un bulletin d'un élève.
     *
     * @param int $studentId
     * @return \Illuminate\View\View
     */
    public function show($studentId)
    {
        // Récupération de l'élève et de ses matières/notes
        $student = Student::with('subjects')->findOrFail($studentId);

        // Affichage de la vue pour un bulletin spécifique
        return view('platform.bulletins.show', compact('student'));
    }

    /**
     * Télécharge le bulletin sous forme de PDF.
     *
     * @param int $studentId
     * @return \Illuminate\Http\Response
     */
    public function generateReport($studentId)
    {
        // Récupération de l'élève et de ses notes
        $student = Student::with('grades')->findOrFail($studentId);
        $grades = $student->grades; // Notes associées à l'élève

        // Chargement de la vue pour générer le contenu PDF
        $pdf = Pdf::loadView('reports.bulletin', compact('student', 'grades'));

        // Définir le chemin de stockage pour le fichier PDF
        $path = "bulletins/{$student->id}_bulletin.pdf";
        Storage::put($path, $pdf->output());

        //  Créer un enregistrement dans la table Reports si nécessaire
        Report::create([
            'student_id' => $studentId,
            'report_path' => $path,
        ]);

        // Téléchargement du fichier PDF généré
        return response()->download(storage_path("app/{$path}"));
    }

}
