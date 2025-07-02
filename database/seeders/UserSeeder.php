<?php

namespace Database\Seeders;

use App\Models\Roles\Role;
use App\Models\Roles\RoleGroup;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::create([
            'name'              => fake()->name(),
            'email'             => 'admin@email.com',
            'email_verified_at' => now(),
            'password'          => '123',
            'is_active'         => true,
            'remember_token'    => Str::random(10),
        ]);

        Role::create([
            'name'          => 'Admin',
            'description'   => 'All rights to the whole panel.',
        ]);
        
        Role::create([
            'name'          => 'User',
            'description'   => 'Can access to specific functions.',
        ]);
        
        Role::create([
            'name'          => 'Customer',
            'description'   => 'Purchasing products.',
        ]);
        
        RoleGroup::create([
            'user_id'   => 1,
            'role_id'   => 1,
        ]);
        
    }
}
