<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create(['username'=> 'manager',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);
    
        \App\Models\User::factory()->create([
            'username' => 'agent',
            'password' => bcrypt('password'),
            'role' => 'agent',
        ]);

        \App\Models\User::factory()->create([
            'username' => 'tester',
            'password' => bcrypt('PASSWORD'),
            'role' => 'manager',
        ]);
    }
}
