<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\SousChapitre;
use App\Http\Requests\Admin\StoreQuizRequest;
use App\Http\Requests\Admin\UpdateQuizRequest;

class QuizController extends Controller
{
    public function index()
    {
        $query = Quiz::with('sousChapitre.chapitre.formation')->withCount('questions');

        if (request('search')) {
            $query->where('titre', 'like', '%' . request('search') . '%');
        }

        $quizzes = $query->latest()->paginate(10);
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        $sousChapitres = SousChapitre::with('chapitre.formation')->orderBy('titre')->get();
        $selectedSousChapitre = request('sous_chapitre_id');
        return view('admin.quiz.create', compact('sousChapitres', 'selectedSousChapitre'));
    }

    public function store(StoreQuizRequest $request)
    {
        $quiz = Quiz::create($request->validated());
        return redirect()->route('admin.quiz.show', $quiz)->with('success', 'Quiz créé avec succès.');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('sousChapitre.chapitre.formation', 'questions.reponses');
        return view('admin.quiz.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $sousChapitres = SousChapitre::with('chapitre.formation')->orderBy('titre')->get();
        return view('admin.quiz.edit', compact('quiz', 'sousChapitres'));
    }

    public function update(UpdateQuizRequest $request, Quiz $quiz)
    {
        $quiz->update($request->validated());
        return redirect()->route('admin.quiz.show', $quiz)->with('success', 'Quiz modifié avec succès.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quiz.index')->with('success', 'Quiz supprimé avec succès.');
    }
}