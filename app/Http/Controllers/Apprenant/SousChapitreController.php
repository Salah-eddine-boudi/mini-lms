<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use App\Models\SousChapitre;

class SousChapitreController extends Controller
{
    public function show(SousChapitre $sousChapitre)
    {
        // Vérifie que l'apprenant est inscrit à la formation
        $formationId = $sousChapitre->chapitre->formation_id;
        $isEnrolled = auth()->user()->formations()->where('formations.id', $formationId)->exists();

        if (!$isEnrolled) {
            abort(403, 'Vous n\'êtes pas inscrit à cette formation.');
        }

        $sousChapitre->load('chapitre.formation', 'quiz');
        return view('apprenant.sous-chapitres.show', compact('sousChapitre'));
    }
}