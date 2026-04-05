<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizResultFactory extends Factory
{
    public function definition(): array
    {
        $total = 10;
        return [
            'user_id' => User::factory(),
            'quiz_id' => Quiz::factory(),
            'score' => fake()->numberBetween(0, $total),
            'total' => $total,
            'completed_at' => now(),
        ];
    }
}