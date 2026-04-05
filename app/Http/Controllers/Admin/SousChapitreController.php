<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SousChapitre;
use App\Models\Chapitre;
use App\Http\Requests\Admin\StoreSousChapitreRequest;
use App\Http\Requests\Admin\UpdateSousChapitreRequest;

class SousChapitreController extends Controller
{
    /**
     * Liste les sous-chapitres, filtrés par chapitre si précisé.
     */
    public function index()
    {
        $query = SousChapitre::with('chapitre.formation');

        if (request('chapitre_id')) {
            $query->where('chapitre_id', request('chapitre_id'));
        }

        if (request('search')) {
            $query->where('titre', 'like', '%' . request('search') . '%');
        }

        $sousChapitres = $query->orderBy('chapitre_id')->orderBy('ordre')->paginate(10);
        $chapitres = Chapitre::with('formation')->orderBy('titre')->get();

        return view('admin.sous-chapitres.index', compact('sousChapitres', 'chapitres'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $chapitres = Chapitre::with('formation')->orderBy('titre')->get();
        $selectedChapitre = request('chapitre_id');

        return view('admin.sous-chapitres.create', compact('chapitres', 'selectedChapitre'));
    }

    /**
     * Enregistre un nouveau sous-chapitre.
     */
    public function store(StoreSousChapitreRequest $request)
    {
        SousChapitre::create($request->validated());

        return redirect()
            ->route('admin.sous-chapitres.index', ['chapitre_id' => $request->chapitre_id])
            ->with('success', 'Sous-chapitre créé avec succès.');
    }

    /**
     * Affiche le contenu d'un sous-chapitre.
     */
    public function show(SousChapitre $sousChapitre)
    {
        $sousChapitre->load('chapitre.formation', 'quiz');

        return view('admin.sous-chapitres.show', compact('sousChapitre'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit(SousChapitre $sousChapitre)
    {
        $chapitres = Chapitre::with('formation')->orderBy('titre')->get();

        return view('admin.sous-chapitres.edit', compact('sousChapitre', 'chapitres'));
    }

    /**
     * Met à jour un sous-chapitre.
     */
    public function update(UpdateSousChapitreRequest $request, SousChapitre $sousChapitre)
    {
        $sousChapitre->update($request->validated());

        return redirect()
            ->route('admin.sous-chapitres.index', ['chapitre_id' => $sousChapitre->chapitre_id])
            ->with('success', 'Sous-chapitre modifié avec succès.');
    }

    /**
     * Supprime un sous-chapitre.
     */
    public function destroy(SousChapitre $sousChapitre)
    {
        $chapitreId = $sousChapitre->chapitre_id;
        $sousChapitre->delete();

        return redirect()
            ->route('admin.sous-chapitres.index', ['chapitre_id' => $chapitreId])
            ->with('success', 'Sous-chapitre supprimé avec succès.');
    }
}