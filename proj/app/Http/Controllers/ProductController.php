<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{

    public function showProduct($id)
    {
        // Знайти продукт за його ID разом із категоріями
        $product = Product::with('category')->find($id);

        // Якщо продукт не знайдений, показати сторінку з повідомленням
        if (!$product) {
            return response()->view('product.notfound', ['id' => $id], 404);
        }

        // Показати сторінку продукту з переданими даними
        return response()->view('product', [
            'product' => $product,
            'categories' => $product->category,
        ]);
    }

     // Створення продукту
    public function createProduct(Request $request)
    {
        // Перевірка вхідних даних
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1255',
            'category_id' => 'nullable|exists:categories,id', // Перевірка на існування категорії

        ]);

        $user = auth()->user();

        // Створення нового продукту
        $product = new Product();
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'] ?? null;
        $product->user_id = $user->id;
        $product->created_at = now();
        $product->updated_at = now();
        $product->save();

        if (!empty($validated['category_id'])) {
            $category = Category::find($validated['category_id']);

            // Отримати всі надкатегорії
            $allCategories = $this->getParentCategories($category);

            // Додати категорії до продукту
            $product->category()->sync($allCategories);
        }


    // Перенаправлення на сторінку продукту
        return redirect()->route('productPage', ['id' => $product->id])
            ->with('success', 'Product created successfully!');

    }

    // Метод для отримання категорії і всіх її надкатегорій
    private function getParentCategories(Category $category)
    {
        $categories = [];
        while ($category) {
            $categories[] = $category->id;
            $category = $category->parent; // Якщо категорії є поле parent_id
        }
        return $categories;
    }

    // Метод для відображення форми створення продукту
    public function showCreateForm()
    {
        $categories = Category::all(); // Отримуємо всі категорії
        return view('addproduct', compact('categories'));
    }


}
