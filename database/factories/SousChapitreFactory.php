<?php

namespace Database\Factories;

use App\Models\Chapitre;
use Illuminate\Database\Eloquent\Factories\Factory;

class SousChapitreFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => fake()->sentence(3),
            'contenu' => '<h2>' . fake()->sentence() . '</h2><p>' . fake()->paragraph() . '</p>',
            'ordre' => fake()->numberBetween(0, 10),
            'chapitre_id' => Chapitre::factory(),
        ];
    }
}