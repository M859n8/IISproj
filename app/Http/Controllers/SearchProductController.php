<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;


class SearchProductController extends Controller
{
    public function search(Request $request)
    {
        // Отримати всі категорії з бази даних
        // $categories = Category::all();
        $categories = Category::where('status', 'Approved')->get();
        // Створюємо дерево категорій
        $tree = $this->buildTree($categories);

        // Створити базовий запит для пошуку продуктів
        $productsQuery = Product::query();

        $users = User::all();
        $farmers = $users->where('role', 'LIKE', "Farmer");

        // Якщо є запит на пошук по імені
        $query = $request->input('query');
        if ($query) {
            $productsQuery->where('name', 'LIKE', "%{$query}%");
        }

        // Якщо обрана категорія
        $categoryId = $request->input('category');
        if ($categoryId) {
            // Шукаемо в обеднаній таблиці категорій та продуктів
            $productsQuery->whereHas('category', function ($subQuery) use ($categoryId) {
                $subQuery->where('categories.id', $categoryId);
            });
        }

        $farmerId = $request->input('farmer');
        if ($farmerId) {
            $productsQuery->where('user_id', $farmerId);
        }

        if ($request->filled('sort_order')) {
            $productsQuery->orderBy('price', $request->input('sort_order') === 'desc' ? 'desc' : 'asc');
        }


        // Отримати результати пошуку
        $products = $productsQuery->get();

        // Повернути форму і результати на ту ж саму сторінку
        return view('search', ['categories' => $tree, 'products' => $products, 'farmers' => $farmers]);
    }
    // Функція для побудови дерева категорій
    private function buildTree($categories, $parentId = null)
    {
        $tree = [];
        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $category->children = $this->buildTree($categories, $category->id);
                $tree[] = $category;
            }
        }
        return $tree;
    }

    public function priceFilter(Request $request)
    {
        $query = Product::query();

        // Сортування за ціною
        if ($request->filled('sort_order')) {
            $query->orderBy('price', $request->input('sort_order') === 'desc' ? 'desc' : 'asc');
        }

        // Отримання продуктів
        $products = $query->get();

        return view('search', compact('products'));
    }
}