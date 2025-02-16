<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invite>
 */
class InviteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nom"=>fake()->lastName(),
            "prenom"=>fake()->firstName(),
            "email"=>fake()->safeEmail(),
            "dateNaissance"=>fake()->dateTimeBetween("2000-01-01","2005-08-01")->format("y-m-d"),
            "numeroTelephone"=>"+ 212 6".fake()->randomNumber(8),
            "genre"=>fake()->randomElement(['M', 'F']),
            "situationFamiliale"=>fake()->randomElement(["marier", "celibataire", "divorcer"]),
            "moyenneDernierAnnee"=>(rand()/getrandmax())*20,
            "filiereActuelle"=>fake()->randomElement(["Math", "Data Engineering", "Data Science","Infomatique"]),
            "filiere_id"=>rand(1,4),
            "couvertureMedicale"=>fake()->randomElement(['AMO','AMC','RAMED']),
            "photo"=>"/invite1.png",
            "created_at"=>now()
        ];
    }
}
