<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Reponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view('admin.quiz.questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'texte' => 'required|string',
            'reponses' => 'required|array|min:2',
            'reponses.*' => 'required|string|max:255',
            'bonne_reponse' => 'required|integer',
        ], [
            'texte.required' => 'La question est obligatoire.',
            'reponses.required' => 'Vous devez fournir au moins 2 réponses.',
            'reponses.*.required' => 'Chaque réponse doit être remplie.',
            'bonne_reponse.required' => 'Vous devez sélectionner la bonne réponse.',
        ]);

        $ordre = $quiz->questions()->count();

        $question = $quiz->questions()->create([
            'texte' => $request->texte,
            'ordre' => $ordre,
        ]);

        foreach ($request->reponses as $index => $texteReponse) {
            if (!empty($texteReponse)) {
                $question->reponses()->create([
                    'texte' => $texteReponse,
                    'is_correct' => $index == $request->bonne_reponse,
                ]);
            }
        }

        return redirect()
            ->route('admin.quiz.show', $quiz)
            ->with('success', 'Question ajoutée avec succès.');
    }

    public function edit(Question $question)
    {
        $question->load('quiz', 'reponses');
        return view('admin.quiz.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'texte' => 'required|string',
            'reponses' => 'required|array|min:2',
            'reponses.*' => 'required|string|max:255',
            'bonne_reponse' => 'required|integer',
        ]);

        $question->update(['texte' => $request->texte]);
        $question->reponses()->delete();

        foreach ($request->reponses as $index => $texteReponse) {
            if (!empty($texteReponse)) {
                $question->reponses()->create([
                    'texte' => $texteReponse,
                    'is_correct' => $index == $request->bonne_reponse,
                ]);
            }
        }

        return redirect()
            ->route('admin.quiz.show', $question->quiz)
            ->with('success', 'Question modifiée avec succès.');
    }

    public function destroy(Question $question)
    {
        $quiz = $question->quiz;
        $question->delete();

        return redirect()
            ->route('admin.quiz.show', $quiz)
            ->with('success', 'Question supprimée avec succès.');
    }
}