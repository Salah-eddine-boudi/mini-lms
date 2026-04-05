<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FormationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'niveau' => fake()->randomElement(['débutant', 'intermédiaire', 'avancé']),
            'duree' => fake()->randomElement(['2 semaines', '1 mois', '3 mois', null]),
        ];
    }
}