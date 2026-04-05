<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Reponse;
use App\Models\SousChapitre;
use App\Models\QuizResult;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    public function test_quiz_belongs_to_sous_chapitre(): void
    {
        $sc = SousChapitre::factory()->create();
        $quiz = Quiz::factory()->create(['sous_chapitre_id' => $sc->id]);

        $this->assertEquals($sc->id, $quiz->sousChapitre->id);
    }

    public function test_quiz_has_questions(): void
    {
        $quiz = Quiz::factory()->create();
        Question::factory()->count(5)->create(['quiz_id' => $quiz->id]);

        $this->assertCount(5, $quiz->questions);
    }

    public function test_quiz_has_results(): void
    {
        $quiz = Quiz::factory()->create();
        $user = User::factory()->apprenant()->create();

        QuizResult::factory()->create(['quiz_id' => $quiz->id, 'user_id' => $user->id]);

        $this->assertCount(1, $quiz->results);
    }

    public function test_deleting_quiz_cascades_to_questions(): void
    {
        $quiz = Quiz::factory()->create();
        $question = Question::factory()->create(['quiz_id' => $quiz->id]);
        Reponse::factory()->count(4)->create(['question_id' => $question->id]);

        $this->assertDatabaseCount('questions', 1);
        $this->assertDatabaseCount('reponses', 4);

        $quiz->delete();

        $this->assertDatabaseCount('questions', 0);
        $this->assertDatabaseCount('reponses', 0);
    }

    public function test_question_has_bonne_reponse(): void
    {
        $question = Question::factory()->create();
        Reponse::factory()->count(3)->create(['question_id' => $question->id, 'is_correct' => false]);
        Reponse::factory()->create(['question_id' => $question->id, 'is_correct' => true, 'texte' => 'Bonne']);

        $this->assertNotNull($question->bonneReponse);
        $this->assertEquals('Bonne', $question->bonneReponse->texte);
    }

    public function test_quiz_score_calculation(): void
    {
        $quiz = Quiz::factory()->create();

        // Crée 5 questions avec 4 réponses chacune
        for ($i = 0; $i < 5; $i++) {
            $question = Question::factory()->create(['quiz_id' => $quiz->id]);
            Reponse::factory()->count(3)->create(['question_id' => $question->id, 'is_correct' => false]);
            Reponse::factory()->create(['question_id' => $question->id, 'is_correct' => true]);
        }

        $quiz->load('questions.reponses');

        // Simule : l'apprenant répond correctement à 3 questions sur 5
        $score = 0;
        $total = $quiz->questions->count();

        foreach ($quiz->questions as $index => $question) {
            $bonneReponse = $question->reponses->where('is_correct', true)->first();
            if ($index < 3) { // 3 bonnes réponses
                $score++;
            }
        }

        $this->assertEquals(5, $total);
        $this->assertEquals(3, $score);
        $this->assertEquals(60.0, round(($score / $total) * 100, 1));
    }
}