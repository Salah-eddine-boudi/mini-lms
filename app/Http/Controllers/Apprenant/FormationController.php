<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;

class FormationController extends Controller
{
    public function index()
    {
        $formations = auth()->user()->formations()->with('chapitres')->get();
        return view('apprenant.formations.index', compact('formations'));
    }

    public function show($id)
    {
        $formation = auth()->user()->formations()
            ->where('formations.id', $id)
            ->firstOrFail();

        $formation->load('chapitres.sousChapitres');
        return view('apprenant.formations.show', compact('formation'));
    }
}