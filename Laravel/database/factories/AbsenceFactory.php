<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Module;
use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence>
 */
class AbsenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $etudiantIds = Etudiant::pluck('id')->toArray();

        $randomEtudiantId = fake()->randomElement($etudiantIds);
        $randomEtudiant = Etudiant::find($randomEtudiantId); // Retrieve the Etudiant model instance

        $randomModuleId = $randomEtudiant->groupe->filiere->modules->random()->id;

        return [
            'etudiant_id' => $randomEtudiantId,
            'module_id' => $randomModuleId,
            'seance1' => fake()->randomElement([true,false]),
            'seance2' => fake()->randomElement([true,false]),
            'seance3' => fake()->randomElement([true,false]),
            'seance4' => fake()->randomElement([true,false]),
            'created_at' => date("2023-12-20"),
            'updated_at' => null,
        ];
    }
}
