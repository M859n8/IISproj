<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Створення базових категорій
        $fruit = Category::create(['name' => 'Fruit']);
        $vegetable = Category::create(['name' => 'Vegetable']);

        // Заповнення продуктами
        Category::create(['name' => 'Apple', 'parent_id' => $fruit->id]);
        Category::create(['name' => 'Tomato', 'parent_id' => $vegetable->id]);
    }
}
