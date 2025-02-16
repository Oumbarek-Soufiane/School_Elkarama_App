<?php

namespace Database\Factories;

use App\Models\Groupe;
use App\Models\Module;
use App\Models\Filiere;
use App\Models\Professeur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tp>
 */
class TpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $professeurIds = Professeur::pluck('id')->toArray();
        $moduleIds = Module::pluck('id')->toArray();
        $groupeIds = Groupe::pluck('id')->toArray();
        $dateFin = fake()->dateTimeBetween('2023-12-01', '2024-04-01');

        return [
            'professeur_id' => fake()->randomElement($professeurIds),
            'module_id' => fake()->randomElement($moduleIds),
            'groupe_id' => fake()->randomElement($groupeIds),
            'sujet' => fake()->sentence,
            'description' => "/description1.pdf",
            'dateFin' => $dateFin,

        ];
    }
}
