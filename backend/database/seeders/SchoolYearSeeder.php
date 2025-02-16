<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolYear;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schoolYears = [
            [
                'name' => '2021-2022',
                'description' => 'Année scolaire 2021-2022',
            ],
            [
                'name' => '2022-2023',
                'description' => 'Année scolaire 2022-2023',
            ],
            [
                'name' => '2023-2024',
                'description' => 'Année scolaire 2023-2024',
                'status' => 'active'
            ],
        ];

        foreach ($schoolYears as $year) {
            SchoolYear::create($year);
        }
    }
}
