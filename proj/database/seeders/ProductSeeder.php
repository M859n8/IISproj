<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Створення записів без фабрики
        Product::create([
            'name' => 'Apple',
            'description' => 'Fresh red apples from the local farm.',
            'price' => 15.99,
            'category_id' => 1, // ID існуючої категорії
        ]);

        Product::create([
            'name' => 'Broccoli',
            'description' => 'Organic green broccoli, rich in vitamins.',
            'price' => 22.50,
            'category_id' => 2, // ID існуючої категорії
        ]);

        Product::create([
            'name' => 'Milk',
            'description' => '1 liter of fresh cow milk.',
            'price' => 20.00,
            'category_id' => 3, // ID існуючої категорії
        ]);

        Product::create([
            'name' => 'Whole Wheat Bread',
            'description' => 'Healthy whole wheat bread baked fresh daily.',
            'price' => 18.00,
            'category_id' => 4, // ID існуючої категорії
        ]);

        Product::create([
            'name' => 'Cheddar Cheese',
            'description' => 'Aged cheddar cheese, perfect for sandwiches.',
            'price' => 45.00,
            'category_id' => 3, // ID існуючої категорії
        ]);
    }
}
