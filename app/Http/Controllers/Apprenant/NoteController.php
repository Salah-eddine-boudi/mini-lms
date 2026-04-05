<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;

class NoteController extends Controller
{
    public function index()
    {
        $notes = auth()->user()->notes()->with('formation')->get();
        $quizResults = auth()->user()->quizResults()->with('quiz.sousChapitre')->latest()->get();
        $moyenne = $notes->count() > 0 ? round($notes->avg('note'), 2) : null;

        return view('apprenant.notes.index', compact('notes', 'quizResults', 'moyenne'));
    }
}