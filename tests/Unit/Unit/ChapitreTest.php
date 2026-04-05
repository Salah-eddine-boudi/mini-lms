<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Formation;
use App\Models\Chapitre;
use App\Models\SousChapitre;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChapitreTest extends TestCase
{
    use RefreshDatabase;

    public function test_chapitre_belongs_to_formation(): void
    {
        $formation = Formation::factory()->create();
        $chapitre = Chapitre::factory()->create(['formation_id' => $formation->id]);

        $this->assertEquals($formation->id, $chapitre->formation->id);
    }

    public function test_chapitre_has_sous_chapitres(): void
    {
        $chapitre = Chapitre::factory()->create();
        SousChapitre::factory()->count(3)->create(['chapitre_id' => $chapitre->id]);

        $this->assertCount(3, $chapitre->sousChapitres);
    }

    public function test_deleting_chapitre_cascades_to_sous_chapitres(): void
    {
        $chapitre = Chapitre::factory()->create();
        SousChapitre::factory()->count(2)->create(['chapitre_id' => $chapitre->id]);

        $this->assertDatabaseCount('sous_chapitres', 2);

        $chapitre->delete();

        $this->assertDatabaseCount('sous_chapitres', 0);
    }
}