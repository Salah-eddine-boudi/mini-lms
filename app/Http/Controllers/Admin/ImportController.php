<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SousChapitre;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    /**
     * Formulaire d'import de contenu IA pour un sous-chapitre.
     */
    public function show(SousChapitre $sousChapitre)
    {
        $sousChapitre->load('chapitre.formation');
        return view('admin.import.show', compact('sousChapitre'));
    }

    /**
     * Enregistre le contenu importé.
     */
    public function store(Request $request, SousChapitre $sousChapitre)
    {
        $request->validate([
            'contenu' => 'required|string',
        ], [
            'contenu.required' => 'Le contenu est obligatoire.',
        ]);

        // Remplace ou ajoute au contenu existant
        if ($request->mode === 'remplacer') {
            $sousChapitre->update(['contenu' => $request->contenu]);
        } else {
            $contenuActuel = $sousChapitre->contenu ?? '';
            $sousChapitre->update(['contenu' => $contenuActuel . "\n" . $request->contenu]);
        }

        return redirect()
            ->route('admin.sous-chapitres.show', $sousChapitre)
            ->with('success', 'Contenu importé avec succès.');
    }
}