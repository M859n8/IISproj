<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class SearchProductController extends Controller
{
    public function search(Request $request)
    {
        // Отримати всі категорії з бази даних
        $categories = Category::all();

        // Створити базовий запит для пошуку продуктів
        $productsQuery = Product::query();

        // Якщо є запит на пошук по імені
        $query = $request->input('query');
        if ($query) {
            $productsQuery->where('name', 'LIKE', "%{$query}%");
        }

        // Якщо обрана категорія
        $categoryId = $request->input('category');
        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }

        // Отримати результати пошуку
        $products = $productsQuery->get();

        // Повернути форму і результати на ту ж саму сторінку
        return view('search', compact('categories', 'products'));
    }
}
