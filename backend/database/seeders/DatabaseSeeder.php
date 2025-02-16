<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SchoolYearSeeder::class,
            LevelSeeder::class,
            AdminSeeder::class,
            SubjectSeeder::class,
            ClassRoomSeeder::class,
            SectionSeeder::class,
            StudentSeeder::class,
            BusSeeder::class,
            TransportStaffSeeder::class,
            TeacherSeeder::class,
            EvaluationSeeder::class,
        ]);
    }
}