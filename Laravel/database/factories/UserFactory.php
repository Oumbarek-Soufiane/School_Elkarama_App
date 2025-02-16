<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;
    private static $counter = 1;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        $role = '';
        if (self::$counter > 0 && self::$counter < 10) {
            $role = 'professeur';
        } else if (self::$counter > 9 && self::$counter < 90) {
            $role = 'tuteur';
        } else if (self::$counter > 89) {
            $role = 'etudiant';
        }
        self::$counter++;
        return [
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => $role,
            'dateNaissance' => fake()->dateTimeBetween('1993-01-01', '2003-12-31'),
            'numeroTelephone' => '+212 6' . fake()->randomNumber(8),
            'genre' => fake()->randomElement(['M', 'F']),
            'situationFamiliale' => fake()->randomElement(['marier', 'celibataire', 'divorcer']),
            'photo' => "/user1.png",
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
