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
            'surname' => 'Kybil',
            'name' => 'Vlada',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'), // Зашифрований пароль
            'role' => 'Admin', // Роль Адміністратора
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
            'surname' => 'Kucher',
            'name' => 'Marina',
            'email' => 'marina@example.com',
            'password' => Hash::make('password456'),
            'role' => 'Farmer',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
