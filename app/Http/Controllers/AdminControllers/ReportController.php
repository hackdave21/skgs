<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generate($SchoolClassId)
    {
        // Logique pour générer les bulletins d’une classe
    }

    public function download($SchoolClassId)
    {
        // Logique pour télécharger les bulletins au format PDF
    }
}
