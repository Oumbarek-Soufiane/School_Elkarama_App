<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Admin;
use App\Models\Groupe;
use App\Models\Module;
use App\Models\Tuteur;
use App\Models\Filiere;
use App\Models\NumGroupe;
use App\Models\GroupeDetail;
use App\Models\TuteurDetail;
use Illuminate\Support\Facades\Hash;

trait AllFactoriesInOneTrait
{
    public function adminFactory()
    {
        User::factory()->create([
            "id" => 1,
            "nom" => "Mrani",
            "prenom" => "Ayoub",
            "email" => "admin@gmail.com",
            "email_verified_at" => "2023-11-28 13:07:50",
            "password" => Hash::make('123456789'),
            "role" => "admin",
            "dateNaissance" => "2002-11-28",
            "numeroTelephone" => "+212 612234752",
            "genre" => "M",
            "situationFamiliale" => "marier",
            "photo" => "/user1.png",
            "remember_token" => null,
        ]);
        Admin::factory(1)->create();
    }
    public function modulesFactory(): void
    {
        Module::factory()->create(['designation' => 'Module1','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 1,'professeur_id' => 1]);
        Module::factory()->create(['designation' => 'Module2','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 1,'professeur_id' => 1]);
        Module::factory()->create(['designation' => 'Module3','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 1,'professeur_id' => 5]);
        Module::factory()->create(['designation' => 'Module4','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 1,'professeur_id' => 5]);

        Module::factory()->create(['designation' => 'Module5','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 2,'professeur_id' => 2]);
        Module::factory()->create(['designation' => 'Module6','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 2,'professeur_id' => 2]);
        Module::factory()->create(['designation' => 'Module7','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 2,'professeur_id' => 6]);
        Module::factory()->create(['designation' => 'Module8','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 2,'professeur_id' => 6]);

        Module::factory()->create(['designation' => 'Module9','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 3,'professeur_id' => 3]);
        Module::factory()->create(['designation' => 'Module10','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 3,'professeur_id' => 3]);
        Module::factory()->create(['designation' => 'Module11','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 3,'professeur_id' => 7]);
        Module::factory()->create(['designation' => 'Module12','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 3,'professeur_id' => 7]);

        Module::factory()->create(['designation' => 'Module13','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 4,'professeur_id' => 4]);
        Module::factory()->create(['designation' => 'Module14','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 4,'professeur_id' => 4]);
        Module::factory()->create(['designation' => 'Module15','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 4,'professeur_id' => 8]);
        Module::factory()->create(['designation' => 'Module16','nombreHeure' => fake()->randomNumber(2),'filiere_id' => 4,'professeur_id' => 8]);
    }

    public function numGroupesFactory(): void
    {
        NumGroupe::factory()->create(['filiere_id' => 1,'a_affecter' => 0]);
        NumGroupe::factory()->create(['filiere_id' => 2,'a_affecter' => 0]);
        NumGroupe::factory()->create(['filiere_id' => 3,'a_affecter' => 0]);
        NumGroupe::factory()->create(['filiere_id' => 4,'a_affecter' => 0]);
    }

    public function tuteurEtudiantFactory($etudiants): void
    {
        Tuteur::all()->each(function (Tuteur $tuteur) use ($etudiants) {
            $etudiant1 = $etudiants->shift();
            $etudiant2 = $etudiants->shift();

            TuteurDetail::create([
                'etudiant_id' => $etudiant1,
                'tuteur_id' => $tuteur->id,
            ]);

            TuteurDetail::create([
                'etudiant_id' => $etudiant2,
                'tuteur_id' => $tuteur->id,
            ]);
        });
    }

    public function groupesFactory(): void
    {
        Groupe::factory()->create(['designation' => 'groupe1','filiere_id' => 1]);
        Groupe::factory()->create(['designation' => 'groupe2','filiere_id' => 1]);
        Groupe::factory()->create(['designation' => 'groupe3','filiere_id' => 2]);
        Groupe::factory()->create(['designation' => 'groupe4','filiere_id' => 2]);
        Groupe::factory()->create(['designation' => 'groupe5','filiere_id' => 3]);
        Groupe::factory()->create(['designation' => 'groupe6','filiere_id' => 3]);
        Groupe::factory()->create(['designation' => 'groupe7','filiere_id' => 4]);
        Groupe::factory()->create(['designation' => 'groupe8','filiere_id' => 4]);
    }
    public function groupeDetailFactory(): void
    {
        GroupeDetail::factory()->create(['professeur_id' => 1 ,'groupe_id' => 1]);
        GroupeDetail::factory()->create(['professeur_id' => 1 ,'groupe_id' => 2]);
        GroupeDetail::factory()->create(['professeur_id' => 2 ,'groupe_id' => 3]);
        GroupeDetail::factory()->create(['professeur_id' => 2 ,'groupe_id' => 4]);
        GroupeDetail::factory()->create(['professeur_id' => 3 ,'groupe_id' => 5]);
        GroupeDetail::factory()->create(['professeur_id' => 3 ,'groupe_id' => 6]);
        GroupeDetail::factory()->create(['professeur_id' => 4 ,'groupe_id' => 7]);
        GroupeDetail::factory()->create(['professeur_id' => 4 ,'groupe_id' => 8]);
        GroupeDetail::factory()->create(['professeur_id' => 5 ,'groupe_id' => 1]);
        GroupeDetail::factory()->create(['professeur_id' => 5 ,'groupe_id' => 2]);
        GroupeDetail::factory()->create(['professeur_id' => 6 ,'groupe_id' => 3]);
        GroupeDetail::factory()->create(['professeur_id' => 6 ,'groupe_id' => 4]);
        GroupeDetail::factory()->create(['professeur_id' => 7 ,'groupe_id' => 5]);
        GroupeDetail::factory()->create(['professeur_id' => 7 ,'groupe_id' => 6]);
        GroupeDetail::factory()->create(['professeur_id' => 8 ,'groupe_id' => 7]);
        GroupeDetail::factory()->create(['professeur_id' => 8 ,'groupe_id' => 8]);
    }

    public function filieresFactory(): void
    {
        Filiere::factory()->create(['designation' => 'Mathematics','emploieDuTemps' => '/emploieDuTemps1.png']);
        Filiere::factory()->create(['designation' => 'Network','emploieDuTemps' => '/emploieDuTemps2.png']);
        Filiere::factory()->create(['designation' => 'Data Engineering','emploieDuTemps' => '/emploieDuTemps3.png']);
        Filiere::factory()->create(['designation' => 'Data Science','emploieDuTemps' => '/emploieDuTemps4.png']);
    }
}
