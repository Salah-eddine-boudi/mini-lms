<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\QuizResult;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuizResultTest extends TestCase
{
    use RefreshDatabase;

    public function test_pourcentage_calculation(): void
    {
        $result = QuizResult::factory()->create(['score' => 8, 'total' => 10]);
        $this->assertEquals(80.0, $result->pourcentage());
    }

    public function test_pourcentage_zero_total(): void
    {
        $result = QuizResult::factory()->create(['score' => 0, 'total' => 0]);
        $this->assertEquals(0, $result->pourcentage());
    }

    public function test_pourcentage_perfect_score(): void
    {
        $result = QuizResult::factory()->create(['score' => 10, 'total' => 10]);
        $this->assertEquals(100.0, $result->pourcentage());
    }

    public function test_result_belongs_to_user(): void
    {
        $user = User::factory()->apprenant()->create();
        $result = QuizResult::factory()->create(['user_id' => $user->id]);

        $this->assertEquals($user->id, $result->user->id);
    }

    public function test_result_belongs_to_quiz(): void
    {
        $quiz = Quiz::factory()->create();
        $result = QuizResult::factory()->create(['quiz_id' => $quiz->id]);

        $this->assertEquals($quiz->id, $result->quiz->id);
    }

    public function test_completed_at_is_cast_to_datetime(): void
    {
        $result = QuizResult::factory()->create(['completed_at' => '2026-04-04 15:30:00']);
        $this->assertInstanceOf(\Carbon\Carbon::class, $result->completed_at);
    }
}