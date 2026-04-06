<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SousChapitre;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Reponse;
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

    /**
     * Formulaire d'import de quiz via IA.
     */
    public function showQuiz(SousChapitre $sousChapitre)
    {
        $sousChapitre->load('chapitre.formation', 'quiz');
        return view('admin.import.quiz', compact('sousChapitre'));
    }

    /**
     * Parse et enregistre un quiz importé via IA.
     * Format attendu : une question par bloc, réponses avec * pour la bonne.
     */
    public function storeQuiz(Request $request, SousChapitre $sousChapitre)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'quiz_text' => 'required|string',
        ], [
            'titre.required' => 'Le titre du quiz est obligatoire.',
            'quiz_text.required' => 'Le contenu du quiz est obligatoire.',
        ]);

        // Crée le quiz (ou utilise l'existant)
        $quiz = $sousChapitre->quiz;
        if (!$quiz) {
            $quiz = Quiz::create([
                'titre' => $request->titre,
                'description' => 'Quiz importé via IA',
                'sous_chapitre_id' => $sousChapitre->id,
            ]);
        }

        // Parse le texte ligne par ligne
        $lines = explode("\n", trim($request->quiz_text));
        $currentQuestion = null;
        $ordre = $quiz->questions()->count();

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            // Détecte une question (commence par un chiffre suivi d'un point ou parenthèse)
            if (preg_match('/^\d+[\.\)\-]\s*(.+)/', $line, $matches)) {
                // Sauvegarde la question précédente si elle existe
                $currentQuestion = Question::create([
                    'texte' => trim($matches[1]),
                    'ordre' => $ordre++,
                    'quiz_id' => $quiz->id,
                ]);
            }
            // Détecte une réponse correcte (commence par * ou contient [correct])
            elseif ($currentQuestion && (str_starts_with($line, '*') || str_contains($line, '[correct]'))) {
                $texte = str_replace(['*', '[correct]'], '', $line);
                $texte = preg_replace('/^[a-dA-D][\.\)\-]\s*/', '', trim($texte));
                Reponse::create([
                    'texte' => trim($texte),
                    'is_correct' => true,
                    'question_id' => $currentQuestion->id,
                ]);
            }
            // Détecte une réponse normale (commence par a. b. c. d. ou -)
            elseif ($currentQuestion && preg_match('/^[a-dA-D\-][\.\)\-]\s*(.+)/', $line, $matches)) {
                Reponse::create([
                    'texte' => trim($matches[1]),
                    'is_correct' => false,
                    'question_id' => $currentQuestion->id,
                ]);
            }
        }

        return redirect()
            ->route('admin.quiz.show', $quiz)
            ->with('success', 'Quiz importé avec succès. Vérifiez les questions et réponses.');
    }
}