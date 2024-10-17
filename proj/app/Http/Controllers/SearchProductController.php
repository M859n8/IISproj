<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchProductController extends Controller
{
    public function search(Request $request)
        {
            // Отримати параметр пошуку з форми
            $query = $request->input('query');

            // Пошук у базі даних (наприклад, по назві продукту)
            $products = Product::where('name', 'LIKE', "%{$query}%")->get();

            // Повернути результати на сторінку
            return view('products.search', compact('products'));
        }
}
