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

        $apple = $user->products()->create([
            'name' => 'Apple Gala green',
            'description' => 'Fresh red apples from the local farm.',
            'quantity' => 5,
            'unit' => 'kg',
            'price' => 15.99,
        ]);

        $apple1 = $user1->products()->create([
            'name' => 'Apple Gala red',
            'description' => 'Fresh red apples from the local farm.',
            'quantity' => 1,
            'unit' => 'kg',
            'price' => 14.99,
        ]);

        $broccoli = $user->products()->create([
            'name' => 'Broccoli',
            'description' => 'Organic green broccoli, rich in vitamins.',
            'quantity' => 10,
            'unit' => 'kg',
            'price' => 22.50,

        ]);

        $milk = $user1->products()->create([
            'name' => 'Milk',
            'description' => '1 liter of fresh cow milk.',
            'quantity' => 1,
            'unit' => 'l',
            'price' => 20.00,

        ]);

        $bread = $user1->products()->create([
            'name' => 'Whole Wheat Bread',
            'description' => 'Healthy whole wheat bread baked fresh daily.',
            'quantity' => 5,
            'unit' => 'peaces',
            'price' => 18.00,

        ]);

        $cheddar = $user->products()->create([
            'name' => 'Cheddar Cheese',
            'description' => 'Aged cheddar cheese, perfect for sandwiches.',
            'quantity' => 1,
            'unit' => 'kg',
            'price' => 45.00,

        ]);

        // products and categories : n-n
        $apple->category()->attach([1, 5, 8]); // Apple belongs to Fruits and Apples
        $apple1->category()->attach([1, 5, 8]); // Apple belongs to Fruits and Apples

        $broccoli->category()->attach(2);         // Broccoli belongs to Vegetables
        $milk->category()->attach(3);                  // Milk belongs to Dairy Products
        $bread->category()->attach(4);                // Bread belongs to Bakery
        $cheddar->category()->attach(3);

    }
}
