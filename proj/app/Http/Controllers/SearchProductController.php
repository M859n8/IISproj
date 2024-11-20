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
        // Створюємо дерево категорій
        $tree = $this->buildTree($categories);

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
            // Шукаемо в обеднаній таблиці категорій та продуктів
            $productsQuery->whereHas('category', function ($subQuery) use ($categoryId) {
                $subQuery->where('categories.id', $categoryId);
            });
        }

        // Отримати результати пошуку
        $products = $productsQuery->get();

        // Повернути форму і результати на ту ж саму сторінку
        return view('search', ['categories' => $tree, 'products' => $products]);
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
}
