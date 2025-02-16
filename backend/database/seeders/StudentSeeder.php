<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            
            $guardianFirstName = "GuardianFirstName$i";
            $guardianLastName = "GuardianLastName$i";
            $guardianCIN = "CIN$i";
            $guardianEmail = "guardian$i@example.com";
            $guardianPassword = Hash::make('password123');
            $guardianPhone = "123456789$i";
            $guardianAddress = "Address $i";
            $guardianGender = $i % 2 == 0 ? 'male' : 'female';
            $guardianNationality = "Nationality $i";
            $guardianRelationship = "Parent";

          
            $guardian = Guardian::create([
                'guardian_first_name' => $guardianFirstName,
                'guardian_last_name' => $guardianLastName,
                'guardian_cin' => $guardianCIN,
                'guardian_email' => $guardianEmail,
                'guardian_password' => $guardianPassword,
                'guardian_phone' => $guardianPhone,
                'guardian_address' => $guardianAddress,
                'guardian_gender' => $guardianGender,
                'guardian_nationality' => $guardianNationality,
                'guardian_relationship' => $guardianRelationship,
            ]);

            $studentFirstName = "StudentFirstName$i";
            $studentLastName = "StudentLastName$i";
            $studentEmail = "student$i@example.com";
            $studentPassword = Hash::make('password123');
            $studentPhoneNumber = "987654321$i";
            $studentAddress = "Student Address $i";
            $studentGender = $i % 2 == 0 ? 'male' : 'female';
            $studentNationality = "Student Nationality $i";
            $studentDateOfBirth = now()->subYears(10 + $i)->format('Y-m-d');
            $studentCityOfBirth = "City $i";
            $studentCountryOfBirth = "Country $i";
            $needsTransportation = $i % 2 == 0;
            $studyTroubles = $i % 2 == 0;
            $studyTroublesDescription = $studyTroubles ? "Description of study troubles $i" : null;

            Student::create([
                'guardian_id' => $guardian->id,
                'section_id' => 1, 
                'group_id' => 1, 
                'cne' => "CNE$i",
                'student_first_name' => $studentFirstName,
                'student_last_name' => $studentLastName,
                'student_date_of_birth' => $studentDateOfBirth,
                'student_city_of_birth' => $studentCityOfBirth,
                'student_country_of_birth' => $studentCountryOfBirth,
                'student_gender' => $studentGender,
                'student_address' => $studentAddress,
                'student_email' => $studentEmail,
                'student_password' => $studentPassword,
                'student_phone_number' => $studentPhoneNumber,
                'student_nationality' => $studentNationality,
                'needs_transportation' => $needsTransportation,
                'student_illnesses' => null,
                'study_troubles' => $studyTroubles,
                'study_troubles_description' => $studyTroublesDescription,
                'image' => null,
            ]);
        }
    }
}