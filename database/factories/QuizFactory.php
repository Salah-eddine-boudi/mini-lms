<?php

namespace Database\Factories;

use App\Models\SousChapitre;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    protected $model = \App\Models\Quiz::class;

    public function definition(): array
    {
        return [
            'titre' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'sous_chapitre_id' => SousChapitre::factory(),
        ];
    }
}