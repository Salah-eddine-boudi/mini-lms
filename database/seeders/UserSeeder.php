<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin LMS',
            'nom' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin@lms.fr',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Apprenants
        User::create([
            'name' => 'Apprenant Un',
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'apprenant1@lms.fr',
            'password' => Hash::make('password'),
            'role' => 'apprenant',
        ]);

        User::create([
            'name' => 'Apprenant Deux',
            'nom' => 'Martin',
            'prenom' => 'Marie',
            'email' => 'apprenant2@lms.fr',
            'password' => Hash::make('password'),
            'role' => 'apprenant',
        ]);

        User::create([
            'name' => 'Apprenant Trois',
            'nom' => 'Durand',
            'prenom' => 'Pierre',
            'email' => 'apprenant3@lms.fr',
            'password' => Hash::make('password'),
            'role' => 'apprenant',
        ]);
    }
}