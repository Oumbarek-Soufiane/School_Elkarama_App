<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evaluation;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evaluations = [
            [
                'teacher_id' => 1,
                'group_id' => 1,
                'subject_id' => 1,
                'school_year_id' => 3, 
                'evaluation_number' => 1,
                'type' => 'Exam',
                'date' => '2024-07-01',
                'start_time' => '10:00',
                'end_time' => '12:00',
                'description' => 'Final exam for the course',
                'status' => 'Scheduled',
                'semester' => 1,
            ],
            [
                'teacher_id' => 2,
                'group_id' => 2,
                'subject_id' => 2,
                'school_year_id' => 3, 
                'evaluation_number' => 2,
                'type' => 'Quiz',
                'date' => '2024-07-10',
                'start_time' => '09:00',
                'end_time' => '10:00',
                'description' => 'Mid-term quiz',
                'status' => 'Scheduled',
                'semester' => 1,
            ],
            [
                'teacher_id' => 3,
                'group_id' => 3,
                'subject_id' => 3,
                'school_year_id' => 3, 
                'evaluation_number' => 3,
                'type' => 'Assignment',
                'date' => '2024-07-15',
                'start_time' => '14:00',
                'end_time' => '16:00',
                'description' => 'Group assignment presentation',
                'status' => 'Scheduled',
                'semester' => 2,
            ],
            [
                'teacher_id' => 4,
                'group_id' => 4,
                'subject_id' => 4,
                'school_year_id' => 3, 
                'evaluation_number' => 4,
                'type' => 'Exam',
                'date' => '2024-07-20',
                'start_time' => '11:00',
                'end_time' => '13:00',
                'description' => 'Final exam for the semester',
                'status' => 'Scheduled',
                'semester' => 2,
            ],
            [
                'teacher_id' => 5,
                'group_id' => 5,
                'subject_id' => 5,
                'school_year_id' => 3, 
                'evaluation_number' => 1,
                'type' => 'Presentation',
                'date' => '2024-07-25',
                'start_time' => '13:00',
                'end_time' => '15:00',
                'description' => 'Individual presentation on research topic',
                'status' => 'Scheduled',
                'semester' => 1,
            ],
        ];

        foreach ($evaluations as $evaluation) {
            Evaluation::create($evaluation);
        }
    }
}