<?php

namespace App\Http\Controllers\Apprenant;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function show(Quiz $quiz)
    {
        $formationId = $quiz->sousChapitre->chapitre->formation_id;
        $isEnrolled = auth()->user()->formations()->where('formations.id', $formationId)->exists();

        if (!$isEnrolled) {
            abort(403, 'Vous n\'êtes pas inscrit à cette formation.');
        }

        $quiz->load('questions.reponses', 'sousChapitre.chapitre.formation');
        return view('apprenant.quiz.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $quiz->load('questions.reponses');

        $score = 0;
        $total = $quiz->questions->count();
        $details = [];

        foreach ($quiz->questions as $question) {
            $selectedReponseId = $request->input('question_' . $question->id);
            $bonneReponse = $question->reponses->where('is_correct', true)->first();
            $isCorrect = $selectedReponseId == $bonneReponse?->id;

            if ($isCorrect) {
                $score++;
            }

            $details[] = [
                'question' => $question->texte,
                'reponse_choisie' => $question->reponses->find($selectedReponseId)?->texte ?? 'Non répondu',
                'bonne_reponse' => $bonneReponse?->texte,
                'is_correct' => $isCorrect,
            ];
        }

        // Enregistre le résultat
        QuizResult::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total' => $total,
            'completed_at' => now(),
        ]);

        return view('apprenant.quiz.result', compact('quiz', 'score', 'total', 'details'));
    }
}