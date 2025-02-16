<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'number' => '101',
                'description' => 'Salle de classe standard',
                'capacity' => 30,
                'type' => 'classroom',
                'availability' => true,
            ],
            [
                'number' => '102',
                'description' => 'Amphithéâtre principal',
                'capacity' => 100,
                'type' => 'amphitheater',
                'availability' => true,
            ],
            [
                'number' => '103',
                'description' => 'Laboratoire de sciences',
                'capacity' => 20,
                'type' => 'lab',
                'availability' => true,
            ],
            [
                'number' => '104',
                'description' => 'Salle des professeurs',
                'capacity' => 10,
                'type' => 'office',
                'availability' => true,
            ],
        ];

        foreach ($rooms as $room) {
            ClassRoom::create($room);
        }
    }
}