<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Formation;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_note(): void
    {
        $admin = User::factory()->admin()->create();
        $apprenant = User::factory()->apprenant()->create();
        $formation = Formation::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/notes', [
            'user_id' => $apprenant->id,
            'formation_id' => $formation->id,
            'note' => 15.50,
            'commentaire' => 'Bon travail',
        ]);

        $response->assertRedirect(route('admin.notes.index'));
        $this->assertDatabaseHas('notes', [
            'user_id' => $apprenant->id,
            'note' => 15.50,
        ]);
    }

    public function test_admin_can_update_note(): void
    {
        $admin = User::factory()->admin()->create();
        $apprenant = User::factory()->apprenant()->create();
        $formation = Formation::factory()->create();
        $note = Note::factory()->create([
            'user_id' => $apprenant->id,
            'formation_id' => $formation->id,
            'note' => 10,
        ]);

        $response = $this->actingAs($admin)->put('/admin/notes/' . $note->id, [
            'user_id' => $apprenant->id,
            'formation_id' => $formation->id,
            'note' => 18.00,
            'commentaire' => 'Excellent',
        ]);

        $response->assertRedirect(route('admin.notes.index'));
        $this->assertDatabaseHas('notes', ['id' => $note->id, 'note' => 18.00]);
    }

    public function test_admin_can_delete_note(): void
    {
        $admin = User::factory()->admin()->create();
        $note = Note::factory()->create();

        $response = $this->actingAs($admin)->delete('/admin/notes/' . $note->id);

        $response->assertRedirect(route('admin.notes.index'));
        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }

    public function test_apprenant_can_view_own_notes(): void
    {
        $apprenant = User::factory()->apprenant()->create();
        Note::factory()->create(['user_id' => $apprenant->id]);

        $response = $this->actingAs($apprenant)->get('/apprenant/notes');

        $response->assertStatus(200);
    }

    public function test_validation_note_between_0_and_20(): void
    {
        $admin = User::factory()->admin()->create();
        $apprenant = User::factory()->apprenant()->create();
        $formation = Formation::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/notes', [
            'user_id' => $apprenant->id,
            'formation_id' => $formation->id,
            'note' => 25,
        ]);

        $response->assertSessionHasErrors('note');
    }

    public function test_apprenant_cannot_access_admin_notes(): void
    {
        $apprenant = User::factory()->apprenant()->create();

        $response = $this->actingAs($apprenant)->get('/admin/notes');

        $response->assertStatus(403);
    }
}