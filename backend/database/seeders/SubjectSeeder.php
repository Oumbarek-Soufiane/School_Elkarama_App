<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'name' => 'Mathématiques',
                'description' => 'Mathématiques générales',
            ],
            [
                'name' => 'Sciences Physiques',
                'description' => 'Sciences physiques et chimie',
            ],
            [
                'name' => 'Langue Arabe',
                'description' => 'Langue arabe et littérature',
            ],
            [
                'name' => 'Histoire-Géographie',
                'description' => 'Histoire et géographie',
            ],
            [
                'name' => 'Éducation Islamique',
                'description' => 'Éducation islamique',
            ],
            [
                'name' => 'Éducation Civique',
                'description' => 'Éducation civique',
            ],
            [
                'name' => 'Informatique',
                'description' => 'Introduction à l\'informatique',
            ],
            [
                'name' => 'Arts Plastiques',
                'description' => 'Arts plastiques',
            ],
            [
                'name' => 'Éducation Physique',
                'description' => 'Éducation physique et sportive',
            ],
            [
                'name' => 'Technologie',
                'description' => 'Technologie et sciences de l\'ingénieur',
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}