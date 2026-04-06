<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Formation;
use App\Models\Chapitre;
use App\Models\SousChapitre;
use App\Models\Quiz;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportFeatureTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private SousChapitre $sousChapitre;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();

        $formation = Formation::factory()->create();
        $chapitre = Chapitre::factory()->create(['formation_id' => $formation->id]);
        $this->sousChapitre = SousChapitre::factory()->create(['chapitre_id' => $chapitre->id, 'contenu' => null]);
    }

    // ========== IMPORT CONTENU IA ==========

    public function test_admin_can_view_import_page(): void
    {
        $response = $this->actingAs($this->admin)
            ->get('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import');

        $response->assertStatus(200);
        $response->assertSee('Importer du contenu');
    }

    public function test_admin_can_import_content_replace_mode(): void
    {
        $html = '<h2>Test</h2><p>Contenu importé via IA</p>';

        $response = $this->actingAs($this->admin)
            ->post('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import', [
                'contenu' => $html,
                'mode' => 'remplacer',
            ]);

        $response->assertRedirect(route('admin.sous-chapitres.show', $this->sousChapitre));
        $this->assertDatabaseHas('sous_chapitres', [
            'id' => $this->sousChapitre->id,
            'contenu' => $html,
        ]);
    }

    public function test_admin_can_import_content_append_mode(): void
    {
        // Met du contenu existant
        $this->sousChapitre->update(['contenu' => '<p>Ancien contenu</p>']);

        $response = $this->actingAs($this->admin)
            ->post('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import', [
                'contenu' => '<p>Nouveau contenu</p>',
                'mode' => 'ajouter',
            ]);

        $response->assertRedirect();

        $this->sousChapitre->refresh();
        $this->assertStringContains('Ancien contenu', $this->sousChapitre->contenu);
        $this->assertStringContains('Nouveau contenu', $this->sousChapitre->contenu);
    }

    public function test_import_content_requires_contenu(): void
    {
        $response = $this->actingAs($this->admin)
            ->post('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import', [
                'contenu' => '',
                'mode' => 'remplacer',
            ]);

        $response->assertSessionHasErrors('contenu');
    }

    public function test_apprenant_cannot_access_import(): void
    {
        $apprenant = User::factory()->apprenant()->create();

        $response = $this->actingAs($apprenant)
            ->get('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import');

        $response->assertStatus(403);
    }

    // ========== IMPORT QUIZ IA ==========

    public function test_admin_can_view_import_quiz_page(): void
    {
        $response = $this->actingAs($this->admin)
            ->get('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import-quiz');

        $response->assertStatus(200);
        $response->assertSee('Importer un quiz');
    }

    public function test_admin_can_import_quiz(): void
    {
        $quizText = "1. Quel est le prétérit de buy ?\na. buyed\n*b. bought\nc. buyed\nd. boughten\n\n2. Quel est le prétérit de bring ?\na. bringed\n*b. brought\nc. brung\nd. brang";

        $response = $this->actingAs($this->admin)
            ->post('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import-quiz', [
                'titre' => 'Quiz Import Test',
                'quiz_text' => $quizText,
            ]);

        $response->assertRedirect();

        // Vérifie que le quiz a été créé
        $this->assertDatabaseHas('quiz', [
            'titre' => 'Quiz Import Test',
            'sous_chapitre_id' => $this->sousChapitre->id,
        ]);

        // Vérifie que les questions ont été créées
        $quiz = Quiz::where('titre', 'Quiz Import Test')->first();
        $this->assertEquals(2, $quiz->questions->count());
    }

    public function test_import_quiz_creates_correct_answers(): void
    {
        $quizText = "1. Quel est le prétérit de go ?\na. goed\n*b. went\nc. gone\nd. gos";

        $this->actingAs($this->admin)
            ->post('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import-quiz', [
                'titre' => 'Quiz Réponses Test',
                'quiz_text' => $quizText,
            ]);

        $quiz = Quiz::where('titre', 'Quiz Réponses Test')->first();
        $question = $quiz->questions->first();

        // Vérifie que la question a des réponses
        $this->assertEquals(4, $question->reponses->count());

        // Vérifie que "went" est la bonne réponse
        $bonneReponse = $question->reponses->where('is_correct', true)->first();
        $this->assertEquals('went', $bonneReponse->texte);
    }

    public function test_import_quiz_adds_to_existing_quiz(): void
    {
        // Crée un quiz existant
        $quiz = Quiz::factory()->create([
            'sous_chapitre_id' => $this->sousChapitre->id,
            'titre' => 'Quiz Existant',
        ]);

        $quizText = "1. Nouvelle question ?\na. réponse a\n*b. réponse b\nc. réponse c\nd. réponse d";

        $this->actingAs($this->admin)
            ->post('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import-quiz', [
                'titre' => 'Quiz Existant',
                'quiz_text' => $quizText,
            ]);

        // Vérifie qu'il n'y a toujours qu'un seul quiz
        $this->assertEquals(1, Quiz::where('sous_chapitre_id', $this->sousChapitre->id)->count());

        // Vérifie que la question a été ajoutée
        $quiz->refresh();
        $this->assertEquals(1, $quiz->questions->count());
    }

    public function test_import_quiz_requires_titre(): void
    {
        $response = $this->actingAs($this->admin)
            ->post('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import-quiz', [
                'titre' => '',
                'quiz_text' => '1. Question ?\na. a\n*b. b',
            ]);

        $response->assertSessionHasErrors('titre');
    }

    public function test_import_quiz_requires_quiz_text(): void
    {
        $response = $this->actingAs($this->admin)
            ->post('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import-quiz', [
                'titre' => 'Quiz Test',
                'quiz_text' => '',
            ]);

        $response->assertSessionHasErrors('quiz_text');
    }

    public function test_apprenant_cannot_import_quiz(): void
    {
        $apprenant = User::factory()->apprenant()->create();

        $response = $this->actingAs($apprenant)
            ->get('/admin/sous-chapitres/' . $this->sousChapitre->id . '/import-quiz');

        $response->assertStatus(403);
    }

    // Méthode helper
    private function assertStringContains(string $needle, string $haystack): void
    {
        $this->assertTrue(
            str_contains($haystack, $needle),
            "Failed asserting that '$haystack' contains '$needle'."
        );
    }
}