<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TuteurDetail>
 */
class TuteurDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // "etudiant_id" => fake()->numberBetween(18,178),
            // "tuteur_id" => fake()->numberBetween(),
        ];
    }
}
