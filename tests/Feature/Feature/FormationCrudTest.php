<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Formation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormationCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->admin()->create();
    }

    public function test_admin_can_list_formations(): void
    {
        Formation::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)->get('/admin/formations');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_formation(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/formations', [
            'nom' => 'Formation Test',
            'description' => 'Description de test',
            'niveau' => 'débutant',
            'duree' => '1 mois',
        ]);

        $response->assertRedirect(route('admin.formations.index'));
        $this->assertDatabaseHas('formations', ['nom' => 'Formation Test']);
    }

    public function test_admin_can_update_formation(): void
    {
        $formation = Formation::factory()->create();

        $response = $this->actingAs($this->admin)->put('/admin/formations/' . $formation->id, [
            'nom' => 'Nom Modifié',
            'description' => 'Description modifiée',
            'niveau' => 'avancé',
        ]);

        $response->assertRedirect(route('admin.formations.index'));
        $this->assertDatabaseHas('formations', ['nom' => 'Nom Modifié']);
    }

    public function test_admin_can_delete_formation(): void
    {
        $formation = Formation::factory()->create();

        $response = $this->actingAs($this->admin)->delete('/admin/formations/' . $formation->id);

        $response->assertRedirect(route('admin.formations.index'));
        $this->assertDatabaseMissing('formations', ['id' => $formation->id]);
    }

    public function test_validation_fails_without_nom(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/formations', [
            'description' => 'Description',
            'niveau' => 'débutant',
        ]);

        $response->assertSessionHasErrors('nom');
    }

    public function test_validation_fails_with_invalid_niveau(): void
    {
        $response = $this->actingAs($this->admin)->post('/admin/formations', [
            'nom' => 'Test',
            'description' => 'Description',
            'niveau' => 'expert',
        ]);

        $response->assertSessionHasErrors('niveau');
    }

    public function test_apprenant_cannot_create_formation(): void
    {
        $apprenant = User::factory()->apprenant()->create();

        $response = $this->actingAs($apprenant)->post('/admin/formations', [
            'nom' => 'Formation Test',
            'description' => 'Description',
            'niveau' => 'débutant',
        ]);

        $response->assertStatus(403);
    }

    public function test_search_formations(): void
    {
        Formation::factory()->create(['nom' => 'Anglais Verbes']);
        Formation::factory()->create(['nom' => 'Maths Algèbre']);

        $response = $this->actingAs($this->admin)->get('/admin/formations?search=Anglais');

        $response->assertStatus(200);
        $response->assertSee('Anglais Verbes');
        $response->assertDontSee('Maths Algèbre');
    }
}