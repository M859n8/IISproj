<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'surname' => 'Doe',
            'name' => 'John',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'), 
            'role' => 'Admin', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'surname' => 'Smith',
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Farmer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'surname' => 'Smith',
            'name' => 'Jane',
            'email' => 'farmer@example.com',
            'password' => Hash::make('123456pass'),
            'role' => 'Farmer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'surname' => 'Connor',
            'name' => 'Sara',
            'email' => 'customer@example.com',
            'password' => Hash::make('123456pass'),
            'role' => 'Customer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
