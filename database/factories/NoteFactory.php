<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'formation_id' => Formation::factory(),
            'note' => fake()->randomFloat(2, 0, 20),
            'commentaire' => fake()->sentence(),
        ];
    }
}