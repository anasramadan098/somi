<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enums\UserRole;
use App\Models\Project;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default owner account
        User::create([
            'name' => 'System Owner',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
            'role' => UserRole::OWNER->value,
            'email_verified_at' => now(),
        ]);

        // Create default employee account
        // User::create([
        //     'name' => 'John Employee',
        //     'email' => 'employee@example.com',
        //     'password' => Hash::make('password'),
        //     'role' => UserRole::EMPLOYEE->value,
        //     'email_verified_at' => now(),
        // ]);

        // // Create additional test users
        // User::factory(8)->create();

        Project::factory(1)->create([
            'name' => 'Project 1',
            'description' => 'Project 1 Description',
            'user_id' => User::first()->id,
        ]);
    }
}
