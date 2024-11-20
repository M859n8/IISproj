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
        $fruits = Category::create(['name' => 'Fruits']); // 1

        Category::create(['name' => 'Vegetables']);

        Category::create(['name' => 'Dairy Products']); //id 3

        $bakery = Category::create(['name' => 'Bakery']); //id 4

        $apple = Category::create(['name' => 'Apples', 'parent_id' => $fruits->id]); // 5
        Category::create(['name' => 'Banana', 'parent_id' => $fruits->id]);
        Category::create(['name' => 'Orange', 'parent_id' => $fruits->id]);

        // Продукти
        Category::create(['name' => 'Apples Gala', 'parent_id' => $apple->id]); //8
        Category::create(['name' => 'Apples Green', 'parent_id' => $apple->id]); //9
    }
}
