<?php

namespace Database\Factories;

use App\Models\Auteur;
use App\Models\Contenu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Contenu>
 */
class ContenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => fake()->sentence(4),
            'categorie' => fake()->randomElement(['video', 'image', 'article']),
            'description' => fake()->paragraph(),
            'auteur_id' => Auteur::factory(),
        ];
    }
}
