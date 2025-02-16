<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buses = [
            [
                'registration_number' => 'A12345',
                'seating_capacity' => 50,
            ],
            [
                'registration_number' => 'B12345',
                'seating_capacity' => 45,
            ],
            [
                'registration_number' => 'C12345',
                'seating_capacity' => 55,
            ],
            [
                'registration_number' => 'D12345',
                'seating_capacity' => 60,
            ],
            [
                'registration_number' => 'E12345',
                'seating_capacity' => 50,
            ],
            [
                'registration_number' => 'F12345',
                'seating_capacity' => 40,
            ],
            [
                'registration_number' => 'G12345',
                'seating_capacity' => 65,
            ],
            [
                'registration_number' => 'H12345',
                'seating_capacity' => 70,
            ],
            [
                'registration_number' => 'I12345',
                'seating_capacity' => 55,
            ],
            [
                'registration_number' => 'J12345',
                'seating_capacity' => 50,
            ],
        ];

        foreach ($buses as $bus) {
            Bus::create($bus);
        }
    }
}