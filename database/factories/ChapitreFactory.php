<?php

namespace Database\Factories;

use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChapitreFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'ordre' => fake()->numberBetween(0, 10),
            'formation_id' => Formation::factory(),
        ];
    }
}