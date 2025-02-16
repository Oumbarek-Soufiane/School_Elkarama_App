<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [
                'name' => 'Maternelle',
                'description' => 'Niveau scolaire université',
            ],
            [
                'name' => 'Primaire',
                'description' => 'Niveau scolaire primaire',
            ],
            [
                'name' => 'Collège',
                'description' => 'Niveau scolaire collège',
            ],
            [
                'name' => 'Lycée',
                'description' => 'Niveau scolaire lycée',
            ],

        ];

        foreach ($levels as $level) {
            Level::create($level);
        }
    }
}