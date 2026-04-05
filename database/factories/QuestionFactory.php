<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'texte' => fake()->sentence() . ' ?',
            'ordre' => fake()->numberBetween(0, 10),
            'quiz_id' => Quiz::factory(),
        ];
    }
}