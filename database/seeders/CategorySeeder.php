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
        $fruits = Category::create(['name' => 'Fruits', 'status' => 'Approved']); // 1

        Category::create(['name' => 'Vegetables', 'status' => 'Approved']); // 2

        Category::create(['name' => 'Dairy Products', 'status' => 'Approved']); // 3

        $bakery = Category::create(['name' => 'Bakery', 'status' => 'Approved']); // 4

        $apple = Category::create(['name' => 'Apples', 'status' => 'Approved', 'parent_id' => $fruits->id]); // 5
        Category::create(['name' => 'Banana', 'status' => 'Approved', 'parent_id' => $fruits->id]);
        Category::create(['name' => 'Orange', 'status' => 'Approved','parent_id' => $fruits->id]);

        Category::create(['name' => 'Apples Gala',  'status' => 'Approved','parent_id' => $apple->id]); //8
        Category::create(['name' => 'Apples Green', 'status' => 'Approved', 'parent_id' => $apple->id]); //9
    }
}
