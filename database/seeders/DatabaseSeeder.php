<?php

namespace Database\Seeders;

use App\Models\Approval;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Role;
use App\Models\Vehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRoleId = Uuid::uuid7();
        $approverRoleId = Uuid::uuid7();

        Role::insert([
            [
                'role_id' => $adminRoleId,
                'role_name' => 'Admin'
            ],
            [
                'role_id' => $approverRoleId,
                'role_name' => 'Approver'
            ]
        ]
        );

        User::insert([
            [
                'user_id' => Uuid::uuid7(),
                'role_id' => $adminRoleId,
                'fullname' => 'Admin 1',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('pass123')
            ],
            [
                'user_id' => Uuid::uuid7(),
                'role_id' => $approverRoleId,
                'fullname' => 'Manager 1',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('pass123')
            ]
        ]);

        User::factory(25)->role('Approver')->create();

        Vehicle::factory(50)->create();

        Reservation::factory(200)->create();

        Approval::factory(400)->create();
    }
}
