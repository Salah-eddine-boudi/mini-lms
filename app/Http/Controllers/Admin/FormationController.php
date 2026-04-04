<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Http\Requests\Admin\StoreFormationRequest;
use App\Http\Requests\Admin\UpdateFormationRequest;

class FormationController extends Controller
{
    /**
     * Liste toutes les formations avec recherche et pagination.
     */
    public function index()
    {
        $query = Formation::query();

        // Recherche par nom
        if (request('search')) {
            $query->where('nom', 'like', '%' . request('search') . '%');
        }

        $formations = $query->withCount('chapitres')->latest()->paginate(10);

        return view('admin.formations.index', compact('formations'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        return view('admin.formations.create');
    }

    /**
     * Enregistre une nouvelle formation.
     */
    public function store(StoreFormationRequest $request)
    {
        Formation::create($request->validated());

        return redirect()
            ->route('admin.formations.index')
            ->with('success', 'Formation créée avec succès.');
    }

    /**
     * Affiche le détail d'une formation.
     */
    public function show(Formation $formation)
    {
        $formation->load('chapitres.sousChapitres');

        return view('admin.formations.show', compact('formation'));
    }

    /**
     * Affiche le formulaire de modification.
     */
    public function edit(Formation $formation)
    {
        return view('admin.formations.edit', compact('formation'));
    }

    /**
     * Met à jour une formation.
     */
    public function update(UpdateFormationRequest $request, Formation $formation)
    {
        $formation->update($request->validated());

        return redirect()
            ->route('admin.formations.index')
            ->with('success', 'Formation modifiée avec succès.');
    }

    /**
     * Supprime une formation.
     */
    public function destroy(Formation $formation)
    {
        $formation->delete();

        return redirect()
            ->route('admin.formations.index')
            ->with('success', 'Formation supprimée avec succès.');
    }
}