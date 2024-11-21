<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(2);
        $user1 = User::find(3);

        // Створення продуктів
        $apple = $user->products()->create([
            'name' => 'Apple Gala green',
            'description' => 'Fresh red apples from the local farm.',
            'quantity' => '5 kg',
            'price' => 15.99,
            // 'user_id' => 1, // Ідентифікатор користувача, який створив продукт
        ]);

        $apple1 = $user1->products()->create([
            'name' => 'Apple Gala red',
            'description' => 'Fresh red apples from the local farm.',
            'quantity' => '1 kg',
            'price' => 14.99,
            // 'user_id' => 1,
        ]);

        $broccoli = $user->products()->create([
            'name' => 'Broccoli',
            'description' => 'Organic green broccoli, rich in vitamins.',
            'quantity' => '10 kg',
            'price' => 22.50,
            // 'user_id' => 1,

        ]);

        $milk = $user1->products()->create([
            'name' => 'Milk',
            'description' => '1 liter of fresh cow milk.',
            'quantity' => '1 l',
            'price' => 20.00,
            // 'user_id' => 1,

        ]);

        $bread = $user1->products()->create([
            'name' => 'Whole Wheat Bread',
            'description' => 'Healthy whole wheat bread baked fresh daily.',
            'quantity' => '5 peace',
            'price' => 18.00,
            // 'user_id' => 2,

        ]);

        $cheddar = $user->products()->create([
            'name' => 'Cheddar Cheese',
            'description' => 'Aged cheddar cheese, perfect for sandwiches.',
            'quantity' => '1 kg',
            'price' => 45.00,
            // 'user_id' => 2,

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
