<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Formation;
use App\Models\Chapitre;
use App\Models\SousChapitre;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Reponse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuizFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function createQuizWithQuestions(): array
    {
        $formation = Formation::factory()->create();
        $chapitre = Chapitre::factory()->create(['formation_id' => $formation->id]);
        $sc = SousChapitre::factory()->create(['chapitre_id' => $chapitre->id]);
        $quiz = Quiz::factory()->create(['sous_chapitre_id' => $sc->id]);

        $bonnesReponses = [];
        for ($i = 0; $i < 3; $i++) {
            $question = Question::factory()->create(['quiz_id' => $quiz->id]);
            Reponse::factory()->count(3)->create(['question_id' => $question->id, 'is_correct' => false]);
            $bonne = Reponse::factory()->create(['question_id' => $question->id, 'is_correct' => true]);
            $bonnesReponses[$question->id] = $bonne->id;
        }

        return ['formation' => $formation, 'quiz' => $quiz, 'bonnesReponses' => $bonnesReponses];
    }

    public function test_apprenant_can_view_quiz(): void
    {
        $data = $this->createQuizWithQuestions();
        $apprenant = User::factory()->apprenant()->create();
        $apprenant->formations()->attach($data['formation']->id);

        $response = $this->actingAs($apprenant)->get('/apprenant/quiz/' . $data['quiz']->id);

        $response->assertStatus(200);
    }

    public function test_apprenant_cannot_view_quiz_if_not_enrolled(): void
    {
        $data = $this->createQuizWithQuestions();
        $apprenant = User::factory()->apprenant()->create();

        $response = $this->actingAs($apprenant)->get('/apprenant/quiz/' . $data['quiz']->id);

        $response->assertStatus(403);
    }

    public function test_apprenant_can_submit_quiz(): void
    {
        $data = $this->createQuizWithQuestions();
        $apprenant = User::factory()->apprenant()->create();
        $apprenant->formations()->attach($data['formation']->id);

        $answers = [];
        foreach ($data['bonnesReponses'] as $questionId => $reponseId) {
            $answers['question_' . $questionId] = $reponseId;
        }

        $response = $this->actingAs($apprenant)->post('/apprenant/quiz/' . $data['quiz']->id . '/submit', $answers);

        $response->assertStatus(200);
        $this->assertDatabaseHas('quiz_results', [
            'user_id' => $apprenant->id,
            'quiz_id' => $data['quiz']->id,
            'score' => 3,
            'total' => 3,
        ]);
    }

    public function test_quiz_score_is_saved_correctly(): void
    {
        $data = $this->createQuizWithQuestions();
        $apprenant = User::factory()->apprenant()->create();
        $apprenant->formations()->attach($data['formation']->id);

        // Répond correctement à 1 question sur 3
        $answers = [];
        $first = true;
        foreach ($data['bonnesReponses'] as $questionId => $reponseId) {
            if ($first) {
                $answers['question_' . $questionId] = $reponseId; // bonne réponse
                $first = false;
            } else {
                // mauvaise réponse : on prend une réponse incorrecte
                $mauvaise = Reponse::where('question_id', $questionId)->where('is_correct', false)->first();
                $answers['question_' . $questionId] = $mauvaise->id;
            }
        }

        $this->actingAs($apprenant)->post('/apprenant/quiz/' . $data['quiz']->id . '/submit', $answers);

        $this->assertDatabaseHas('quiz_results', [
            'user_id' => $apprenant->id,
            'score' => 1,
            'total' => 3,
        ]);
    }

    public function test_admin_can_create_quiz(): void
    {
        $admin = User::factory()->admin()->create();
        $sc = SousChapitre::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/quiz', [
            'titre' => 'Quiz Test',
            'description' => 'Description test',
            'sous_chapitre_id' => $sc->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('quiz', ['titre' => 'Quiz Test']);
    }
}