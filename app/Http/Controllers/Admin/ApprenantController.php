<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Formation;
use App\Http\Requests\Admin\StoreApprenantRequest;
use App\Http\Requests\Admin\UpdateApprenantRequest;
use Illuminate\Support\Facades\Hash;

class ApprenantController extends Controller
{
    /**
     * Liste tous les apprenants.
     */
    public function index()
    {
        $query = User::where('role', 'apprenant')->withCount('formations');

        if (request('search')) {
            $query->where(function ($q) {
                $q->where('nom', 'like', '%' . request('search') . '%')
                  ->orWhere('prenom', 'like', '%' . request('search') . '%')
                  ->orWhere('email', 'like', '%' . request('search') . '%');
            });
        }

        $apprenants = $query->latest()->paginate(10);

        return view('admin.apprenants.index', compact('apprenants'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('admin.apprenants.create');
    }

    /**
     * Enregistre un nouvel apprenant.
     */
    public function store(StoreApprenantRequest $request)
    {
        User::create([
            'name' => $request->prenom . ' ' . $request->nom,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'apprenant',
        ]);

        return redirect()
            ->route('admin.apprenants.index')
            ->with('success', 'Apprenant créé avec succès.');
    }

    /**
     * Affiche le détail d'un apprenant.
     */
    public function show(User $apprenant)
    {
        $apprenant->load('formations', 'notes.formation', 'quizResults.quiz');

        return view('admin.apprenants.show', compact('apprenant'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit(User $apprenant)
    {
        return view('admin.apprenants.edit', compact('apprenant'));
    }

    /**
     * Met à jour un apprenant.
     */
    public function update(UpdateApprenantRequest $request, User $apprenant)
    {
        $data = [
            'name' => $request->prenom . ' ' . $request->nom,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
        ];

        // Met à jour le mot de passe seulement s'il est rempli
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $apprenant->update($data);

        return redirect()
            ->route('admin.apprenants.index')
            ->with('success', 'Apprenant modifié avec succès.');
    }

    /**
     * Supprime un apprenant.
     */
    public function destroy(User $apprenant)
    {
        $apprenant->delete();

        return redirect()
            ->route('admin.apprenants.index')
            ->with('success', 'Apprenant supprimé avec succès.');
    }

    /**
     * Page d'inscription aux formations.
     */
    public function enrollments(User $apprenant)
    {
        $formations = Formation::orderBy('nom')->get();
        $enrolledIds = $apprenant->formations->pluck('id')->toArray();

        return view('admin.apprenants.enrollments', compact('apprenant', 'formations', 'enrolledIds'));
    }

    /**
     * Sauvegarde les inscriptions.
     */
    public function updateEnrollments(User $apprenant)
    {
        $formationIds = request('formations', []);

        $apprenant->formations()->sync($formationIds);

        return redirect()
            ->route('admin.apprenants.show', $apprenant)
            ->with('success', 'Inscriptions mises à jour avec succès.');
    }
}