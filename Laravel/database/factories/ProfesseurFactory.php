<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professeur>
 */
class ProfesseurFactory extends Factory
{
    private static $counter = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        self::$counter++;

        return [
            "user_id" => self::$counter,
            "diplome" => fake()->word(),
            "dateEmbauche" => fake()->date(),
            "salaire" => fake()->randomFloat(2, 2000, 10000),
        ];
    }
}
