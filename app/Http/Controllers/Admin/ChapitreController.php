<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapitre;
use App\Models\Formation;
use App\Http\Requests\Admin\StoreChapitreRequest;
use App\Http\Requests\Admin\UpdateChapitreRequest;

class ChapitreController extends Controller
{
    /**
     * Liste les chapitres, filtrés par formation si précisé.
     */
    public function index()
    {
        $query = Chapitre::with('formation')->withCount('sousChapitres');

        // Filtre par formation
        if (request('formation_id')) {
            $query->where('formation_id', request('formation_id'));
        }

        // Recherche par titre
        if (request('search')) {
            $query->where('titre', 'like', '%' . request('search') . '%');
        }

        $chapitres = $query->orderBy('formation_id')->orderBy('ordre')->paginate(10);
        $formations = Formation::orderBy('nom')->get();

        return view('admin.chapitres.index', compact('chapitres', 'formations'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $formations = Formation::orderBy('nom')->get();
        $selectedFormation = request('formation_id');

        return view('admin.chapitres.create', compact('formations', 'selectedFormation'));
    }

    /**
     * Enregistre un nouveau chapitre.
     */
    public function store(StoreChapitreRequest $request)
    {
        Chapitre::create($request->validated());

        return redirect()
            ->route('admin.chapitres.index', ['formation_id' => $request->formation_id])
            ->with('success', 'Chapitre créé avec succès.');
    }

    /**
     * Affiche le détail d'un chapitre avec ses sous-chapitres.
     */
    public function show(Chapitre $chapitre)
    {
        $chapitre->load('formation', 'sousChapitres');

        return view('admin.chapitres.show', compact('chapitre'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit(Chapitre $chapitre)
    {
        $formations = Formation::orderBy('nom')->get();

        return view('admin.chapitres.edit', compact('chapitre', 'formations'));
    }

    /**
     * Met à jour un chapitre.
     */
    public function update(UpdateChapitreRequest $request, Chapitre $chapitre)
    {
        $chapitre->update($request->validated());

        return redirect()
            ->route('admin.chapitres.index', ['formation_id' => $chapitre->formation_id])
            ->with('success', 'Chapitre modifié avec succès.');
    }

    /**
     * Supprime un chapitre.
     */
    public function destroy(Chapitre $chapitre)
    {
        $formationId = $chapitre->formation_id;
        $chapitre->delete();

        return redirect()
            ->route('admin.chapitres.index', ['formation_id' => $formationId])
            ->with('success', 'Chapitre supprimé avec succès.');
    }
}