<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Створення продуктів
        $farmer1 = User::create([
            'surname' => 'Jon',
            'name' => 'Doe',
            'email' => 'farm1@gmail.com',
            'password' => 'sdfsdfsf',
            'role' => 'Farmer',
        ]);
        $farmer2 = User::create([
            'surname' => 'Anna',
            'name' => 'Doe',
            'email' => 'farm2@gmail.com',
            'password' => 'sdfssdfsfdfsf',
            'role' => 'Farmer',
        ]);


    }
}
