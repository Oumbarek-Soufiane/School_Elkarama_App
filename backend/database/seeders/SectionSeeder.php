<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Level;
use App\Models\Group;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maternelle = Level::where('name', 'Maternelle')->first()->id;
        $primaire = Level::where('name', 'Primaire')->first()->id;
        $college = Level::where('name', 'Collège')->first()->id;
        $lycee = Level::where('name', 'Lycée')->first()->id;

        $sections = [
            ['name' => 'Petite Section', 'level_id' => $maternelle, 'description' => 'Classe pour les tout-petits', 'school_fees_per_month' => 500.0],
            ['name' => 'Moyenne Section', 'level_id' => $maternelle, 'description' => 'Classe moyenne pour les petits', 'school_fees_per_month' => 600.0],
            ['name' => 'Grande Section', 'level_id' => $maternelle, 'description' => 'Classe préparatoire pour le primaire', 'school_fees_per_month' => 700.0],

            ['name' => 'CP', 'level_id' => $primaire, 'description' => 'Cours préparatoire', 'school_fees_per_month' => 800.0],
            ['name' => 'CE1', 'level_id' => $primaire, 'description' => 'Cours élémentaire 1ère année', 'school_fees_per_month' => 850.0],
            ['name' => 'CE2', 'level_id' => $primaire, 'description' => 'Cours élémentaire 2ème année', 'school_fees_per_month' => 900.0],
            ['name' => 'CM1', 'level_id' => $primaire, 'description' => 'Cours moyen 1ère année', 'school_fees_per_month' => 950.0],
            ['name' => 'CM2', 'level_id' => $primaire, 'description' => 'Cours moyen 2ème année', 'school_fees_per_month' => 1000.0],

            ['name' => '1er collège', 'level_id' => $college, 'description' => 'Première année du collège', 'school_fees_per_month' => 1100.0],
            ['name' => '2eme collège', 'level_id' => $college, 'description' => 'Deuxième année du collège', 'school_fees_per_month' => 1200.0],
            ['name' => '3eme collège', 'level_id' => $college, 'description' => 'Troisième année du collège', 'school_fees_per_month' => 1300.0],

            ['name' => 'Tronc Commun - Sciences', 'level_id' => $lycee, 'description' => 'Première année du lycée', 'school_fees_per_month' => 1500.0],
            ['name' => 'Tronc Commun - Technologies', 'level_id' => $lycee, 'description' => 'Première année du lycée', 'school_fees_per_month' => 1500.0],
            ['name' => 'Tronc Commun - Lettres et Sciences Humaines', 'level_id' => $lycee, 'description' => 'Première année du lycée', 'school_fees_per_month' => 1500.0],
            ['name' => '1ère Bac - Sciences Mathématiques', 'level_id' => $lycee, 'description' => 'Deuxième année du lycée', 'school_fees_per_month' => 1600.0],
            ['name' => '1ère Bac - Sciences Expérimentales', 'level_id' => $lycee, 'description' => 'Deuxième année du lycée', 'school_fees_per_month' => 1600.0],
            ['name' => '1ère Bac - Lettres et Sciences Humaines', 'level_id' => $lycee, 'description' => 'Deuxième année du lycée', 'school_fees_per_month' => 1600.0],
            ['name' => '1ère Bac - Sciences Économiques et Gestion', 'level_id' => $lycee, 'description' => 'Deuxième année du lycée', 'school_fees_per_month' => 1600.0],
            ['name' => '2ème Bac - Sciences Mathématiques A', 'level_id' => $lycee, 'description' => 'Troisième année du lycée', 'school_fees_per_month' => 1700.0],
            ['name' => '2ème Bac - Sciences Mathématiques B', 'level_id' => $lycee, 'description' => 'Troisième année du lycée', 'school_fees_per_month' => 1700.0],
            ['name' => '2ème Bac - Sciences Sciences Physiques', 'level_id' => $lycee, 'description' => 'Troisième année du lycée', 'school_fees_per_month' => 1700.0],
            ['name' => '2ème Bac - Sciences Sciences de la Vie et de la Terre (SVT)', 'level_id' => $lycee, 'description' => 'Troisième année du lycée', 'school_fees_per_month' => 1700.0],
        ];

        foreach ($sections as $sectionData) {
            $section = Section::create($sectionData);

            Group::create([
                'name' => $section->name . ' - Group 1',
                'section_id' => $section->id,
                'description' => 'Group 1 pour ' . $section->name,
                'capacity' => 30,
            ]);

            Group::create([
                'name' => $section->name . ' - Group 2',
                'section_id' => $section->id,
                'description' => 'Group 2 pour ' . $section->name,
                'capacity' => 30,
            ]);
        }
    }
}