<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admins = [
            [
                'cin' => 'adminCIN123',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'date_of_birth' => '1990-01-01',
                'gender' => 'male',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin@123'),
                'phone' => '1234567890',
                'address' => 'Admin Address',
                'role' => 'admin',
                'image' => null,
            ], [
                'cin' => 'superAdminCIN123',
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'date_of_birth' => '1985-01-01',
                'gender' => 'male',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('superadmin@123'),
                'phone' => '0987654321',
                'address' => 'Super Admin Address',
                'role' => 'super_admin',
                'image' => null,
            ]

        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }
    }
}