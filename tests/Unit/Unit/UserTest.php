<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Formation;
use App\Models\Note;
use App\Models\QuizResult;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_admin(): void
    {
        $user = User::factory()->admin()->create();
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isApprenant());
    }

    public function test_user_is_apprenant(): void
    {
        $user = User::factory()->apprenant()->create();
        $this->assertTrue($user->isApprenant());
        $this->assertFalse($user->isAdmin());
    }

    public function test_user_has_formations_relation(): void
    {
        $user = User::factory()->apprenant()->create();
        $formation = Formation::factory()->create();

        $user->formations()->attach($formation->id, ['enrolled_at' => now()]);

        $this->assertCount(1, $user->formations);
        $this->assertEquals($formation->id, $user->formations->first()->id);
    }

    public function test_user_has_notes_relation(): void
    {
        $user = User::factory()->apprenant()->create();
        $formation = Formation::factory()->create();

        Note::factory()->create([
            'user_id' => $user->id,
            'formation_id' => $formation->id,
        ]);

        $this->assertCount(1, $user->notes);
    }

    public function test_user_has_quiz_results_relation(): void
    {
        $user = User::factory()->apprenant()->create();

        QuizResult::factory()->create(['user_id' => $user->id]);

        $this->assertCount(1, $user->quizResults);
    }

    public function test_default_role_is_apprenant(): void
    {
        $user = User::factory()->create();
        $this->assertEquals('apprenant', $user->role);
    }

    public function test_password_is_hidden(): void
    {
        $user = User::factory()->create();
        $array = $user->toArray();

        $this->assertArrayNotHasKey('password', $array);
        $this->assertArrayNotHasKey('remember_token', $array);
    }
}