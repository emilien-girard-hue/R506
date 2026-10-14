<?php

namespace Database\Seeders;

use App\Models\Auteur;
use App\Models\Categorie;
use App\Models\Commentaire;
use App\Models\Contenu;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    use HasFactory;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $auteurs = Auteur::factory()->count(10)->create();
        $categories = Categorie::factory()->count(5)->create();
        $commentaire = Commentaire::factory();

        Contenu::factory()
            ->count(50)
            ->create(['auteur_id' => fn() => $auteurs->random()->id])
            ->each(function ($contenu) use ($categories, $commentaire) {
                $contenu->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id'),
                );
                $commentaire->count(rand(2, 5))->create()->each(
                    function ($commentaire) use ($contenu) {
                        $commentaire['contenu_id'] = $contenu['id'];
                    }
                );
            });

        // Contenu::factory()
        //     ->count(50)
        //     ->create(['auteur_id' => fn() => $auteurs->random()->id])
        //     ->each(function ($contenu) use ($categories) {
        //         $contenu->categories()->attach(
        //             $categories->random(rand(1, 3))->pluck('id'),
        //         );
        //     });
    }
}
