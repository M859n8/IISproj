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

        Category::create([
            'name' => 'Vegetables', // ID 2
        ]);

        Category::create([
            'name' => 'Dairy Products', // ID 3
        ]);

        Category::create([
            'name' => 'Bakery', // ID 4
        ]);

        Category::create(['name' => 'Apples', 'parent_id' => $fruits->id]); // 5
    }
}
