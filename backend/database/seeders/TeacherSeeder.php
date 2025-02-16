<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            [
                'teacher_cin' => 'V123456',
                'teacher_first_name' => 'Ahmed',
                'teacher_last_name' => 'Ben Ali',
                'teacher_date_of_birth' => '1982-03-10',
                'teacher_place_of_birth' => 'Rabat',
                'teacher_gender' => 'male',
                'teacher_address' => '23 Avenue Hassan II',
                'teacher_email' => 'ahmed.benali@example.com',
                'teacher_password' => Hash::make('password'),
                'teacher_phone_number' => '0612345678',
                'teacher_nationality' => 'Marocaine',
                'teacher_diploma' => 'Licence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'teacher_cin' => 'V654321',
                'teacher_first_name' => 'Fatima',
                'teacher_last_name' => 'Zahra',
                'teacher_date_of_birth' => '1984-08-15',
                'teacher_place_of_birth' => 'Casablanca',
                'teacher_gender' => 'female',
                'teacher_address' => '15 Rue Mohammed V',
                'teacher_email' => 'fatima.zahra@example.com',
                'teacher_password' => Hash::make('password'),
                'teacher_phone_number' => '0623456789',
                'teacher_nationality' => 'Marocaine',
                'teacher_diploma' => 'Master',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'teacher_cin' => 'V987654',
                'teacher_first_name' => 'Mohammed',
                'teacher_last_name' => 'El Amrani',
                'teacher_date_of_birth' => '1978-12-20',
                'teacher_place_of_birth' => 'Marrakech',
                'teacher_gender' => 'male',
                'teacher_address' => '7 Rue Moulay Rachid',
                'teacher_email' => 'mohammed.elamrani@example.com',
                'teacher_password' => Hash::make('password'),
                'teacher_phone_number' => '0634567890',
                'teacher_nationality' => 'Marocaine',
                'teacher_diploma' => 'Doctorat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'teacher_cin' => 'V456789',
                'teacher_first_name' => 'Khadija',
                'teacher_last_name' => 'Bouhaddou',
                'teacher_date_of_birth' => '1981-06-25',
                'teacher_place_of_birth' => 'Fes',
                'teacher_gender' => 'female',
                'teacher_address' => '10 Avenue Mohammed VI',
                'teacher_email' => 'khadija.bouhaddou@example.com',
                'teacher_password' => Hash::make('password'),
                'teacher_phone_number' => '0645678901',
                'teacher_nationality' => 'Marocaine',
                'teacher_diploma' => 'Ingénieur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'teacher_cin' => 'V234567',
                'teacher_first_name' => 'Youssef',
                'teacher_last_name' => 'El Khatib',
                'teacher_date_of_birth' => '1983-09-30',
                'teacher_place_of_birth' => 'Tangier',
                'teacher_gender' => 'male',
                'teacher_address' => '5 Boulevard Mohamed V',
                'teacher_email' => 'youssef.elkhatib@example.com',
                'teacher_password' => Hash::make('password'),
                'teacher_phone_number' => '0656789012',
                'teacher_nationality' => 'Marocaine',
                'teacher_diploma' => 'BTS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'teacher_cin' => 'V345678',
                'teacher_first_name' => 'Amina',
                'teacher_last_name' => 'El Mokhtar',
                'teacher_date_of_birth' => '1980-11-05',
                'teacher_place_of_birth' => 'Agadir',
                'teacher_gender' => 'female',
                'teacher_address' => '12 Rue Mohammed III',
                'teacher_email' => 'amina.elmokhtar@example.com',
                'teacher_password' => Hash::make('password'),
                'teacher_phone_number' => '0667890123',
                'teacher_nationality' => 'Marocaine',
                'teacher_diploma' => 'Licence',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}