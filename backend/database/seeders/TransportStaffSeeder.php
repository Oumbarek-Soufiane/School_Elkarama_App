<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransportStaff;

class TransportStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = [
            [
                'bus_id' => 1,
                'cin' => 'A123456',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'date_of_birth' => '1990-05-15',
                'gender' => 'male',
                'address' => '123 Main Street, Casablanca',
                'email' => 'john.doe@example.com',
                'phone_number' => '+212612345678',
                'nationality' => 'Moroccan',
                'role' => 'driver',
            ],
            [
                'bus_id' => 2,
                'cin' => 'B123456',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'date_of_birth' => '1985-08-25',
                'gender' => 'female',
                'address' => '456 Elm Avenue, Rabat',
                'email' => 'jane.smith@example.com',
                'phone_number' => '+212621234567',
                'nationality' => 'Moroccan',
                'role' => 'assistant',
            ],
            [
                'bus_id' => 3,
                'cin' => 'C123456',
                'first_name' => 'Mohammed',
                'last_name' => 'Abdullah',
                'date_of_birth' => '1995-02-10',
                'gender' => 'male',
                'address' => '789 Oak Road, Marrakech',
                'email' => 'mohammed.abdullah@example.com',
                'phone_number' => '+212633445566',
                'nationality' => 'Moroccan',
                'role' => 'driver',
            ],
            [
                'bus_id' => 4,
                'cin' => 'D123456',
                'first_name' => 'Fatima',
                'last_name' => 'Zahra',
                'date_of_birth' => '1988-11-20',
                'gender' => 'female',
                'address' => '321 Pine Boulevard, Tangier',
                'email' => 'fatima.zahra@example.com',
                'phone_number' => '+212644556677',
                'nationality' => 'Moroccan',
                'role' => 'assistant',
            ],
            [
                'bus_id' => 5,
                'cin' => 'E123456',
                'first_name' => 'Ahmed',
                'last_name' => 'Ali',
                'date_of_birth' => '1992-07-05',
                'gender' => 'male',
                'address' => '567 Cedar Lane, Fes',
                'email' => 'ahmed.ali@example.com',
                'phone_number' => '+212655667788',
                'nationality' => 'Moroccan',
                'role' => 'driver',
            ],
            [
                'bus_id' => 6,
                'cin' => 'F123456',
                'first_name' => 'Amina',
                'last_name' => 'Omar',
                'date_of_birth' => '1987-04-12',
                'gender' => 'female',
                'address' => '876 Maple Street, Agadir',
                'email' => 'amina.omar@example.com',
                'phone_number' => '+212666778899',
                'nationality' => 'Moroccan',
                'role' => 'assistant',
            ],
        ];

        foreach ($staff as $person) {
            TransportStaff::create($person);
        }
    }
}