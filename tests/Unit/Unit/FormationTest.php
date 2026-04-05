<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Formation;
use App\Models\Chapitre;
use App\Models\User;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormationTest extends TestCase
{
    use RefreshDatabase;

    public function test_formation_has_chapitres_relation(): void
    {
        $formation = Formation::factory()->create();
        Chapitre::factory()->count(3)->create(['formation_id' => $formation->id]);

        $this->assertCount(3, $formation->chapitres);
    }

    public function test_formation_has_apprenants_relation(): void
    {
        $formation = Formation::factory()->create();
        $user = User::factory()->apprenant()->create();

        $formation->apprenants()->attach($user->id, ['enrolled_at' => now()]);

        $this->assertCount(1, $formation->apprenants);
    }

    public function test_formation_has_notes_relation(): void
    {
        $formation = Formation::factory()->create();
        $user = User::factory()->apprenant()->create();

        Note::factory()->create([
            'user_id' => $user->id,
            'formation_id' => $formation->id,
        ]);

        $this->assertCount(1, $formation->notes);
    }

    public function test_chapitres_are_ordered_by_ordre(): void
    {
        $formation = Formation::factory()->create();
        Chapitre::factory()->create(['formation_id' => $formation->id, 'ordre' => 3]);
        Chapitre::factory()->create(['formation_id' => $formation->id, 'ordre' => 1]);
        Chapitre::factory()->create(['formation_id' => $formation->id, 'ordre' => 2]);

        $chapitres = $formation->chapitres;

        $this->assertEquals(1, $chapitres[0]->ordre);
        $this->assertEquals(2, $chapitres[1]->ordre);
        $this->assertEquals(3, $chapitres[2]->ordre);
    }

    public function test_deleting_formation_cascades_to_chapitres(): void
    {
        $formation = Formation::factory()->create();
        Chapitre::factory()->count(2)->create(['formation_id' => $formation->id]);

        $this->assertDatabaseCount('chapitres', 2);

        $formation->delete();

        $this->assertDatabaseCount('chapitres', 0);
    }
}