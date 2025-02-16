<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Note;
use App\Models\Devoir;
use App\Models\Invite;
use App\Models\Absence;
use App\Models\Etudiant;
use App\Models\Professeur;
use App\Models\Tp;
use App\Models\Tuteur;
use App\Models\TuteurDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Factories\AllFactoriesInOneTrait;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    use AllFactoriesInOneTrait;
    public function run(): void
    {
        // Admin
        $this->adminFactory();

        // Users
        User::factory(248)->create();

        // Professeur
        Professeur::factory(8)->create();

        // Filieres
        $this->filieresFactory();

        // Modules foreach Professeur
        $this->modulesFactory();

        // Groupes
        $this->groupesFactory();

        // Pour donne chaque etudiant sont groupe
        $this->numGroupesFactory();

        // Etudiant
        Etudiant::factory(160)->create();

        // Groupe Details
        $this->groupeDetailFactory();

        // Tuteur
        Tuteur::factory(80)->create();

        // Tuteur etudiant
        $this->tuteurEtudiantFactory(Etudiant::pluck('id'));

        // Les Tps
        Tp::factory(40)->create();

        // Les devoirs
        Devoir::factory(1)->create();

        // Les notes
        // Note::factory(1)->create();

        // Les invites
        Invite::factory(16)->create();

        // Les absence
        // Absence::factory(10)->create();
    }
}
