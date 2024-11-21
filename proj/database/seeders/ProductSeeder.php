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
        // Створення продуктів
        $apple = Product::create([
            'name' => 'Apple Gala green',
            'description' => 'Fresh red apples from the local farm.',
            'price' => 15.99,
            'user_id' => 1, // Ідентифікатор користувача, який створив продукт
        ]);
        $apple1 = Product::create([
            'name' => 'Apple Gala red',
            'description' => 'Fresh red apples from the local farm.',
            'price' => 14.99,
            'user_id' => 1,
        ]);

        $broccoli = Product::create([
            'name' => 'Broccoli',
            'description' => 'Organic green broccoli, rich in vitamins.',
            'price' => 22.50,
            'user_id' => 1,

        ]);

        $milk = Product::create([
            'name' => 'Milk',
            'description' => '1 liter of fresh cow milk.',
            'price' => 20.00,
            'user_id' => 1,

        ]);

        $bread = Product::create([
            'name' => 'Whole Wheat Bread',
            'description' => 'Healthy whole wheat bread baked fresh daily.',
            'price' => 18.00,
            'user_id' => 2,

        ]);

        $cheddar = Product::create([
            'name' => 'Cheddar Cheese',
            'description' => 'Aged cheddar cheese, perfect for sandwiches.',
            'price' => 45.00,
            'user_id' => 2,

        ]);

        // Продукти та категорії (багато до багатьох)
        $apple->category()->attach([1, 5, 8]); // Apple належить до категорій Fruits і Apples
        $apple1->category()->attach([1, 5, 8]); // Apple належить до категорій Fruits і Apples

        $broccoli->category()->attach(2);         // Broccoli належить до категорії Vegetables
        $milk->category()->attach(3);                  // Milk належить до категорії Dairy Products
        $bread->category()->attach(4);                // Bread належить до категорії Bakery
        $cheddar->category()->attach(3);


    }
}
