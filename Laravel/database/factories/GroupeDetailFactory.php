<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupeDetail>
 */
class GroupeDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // "professeur_id" => fake()->numberBetween(),
            // "groupe_id" => fake()->numberBetween(),
            // 'designation' => fake()->unique()->word(),
        ];
    }
}
