<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReponseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'texte' => fake()->word(),
            'is_correct' => false,
            'question_id' => Question::factory(),
        ];
    }
}