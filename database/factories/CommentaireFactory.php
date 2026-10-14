<?php

namespace Database\Factories;

use App\Models\Commentaire;
use App\Models\Contenu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Commentaire>
 */
class CommentaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_auteur' => fake()->sentence(4),
            'texte' => fake()->paragraph(),
            'contenu_id' => Contenu::factory(),
        ];
    }
}
