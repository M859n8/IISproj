<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchProductController extends Controller
{
    public function search(Request $request)
        {
            // Отримати параметр пошуку з форми
            $query = $request->input('query');

            // Пошук у базі даних (наприклад, по назві продукту)
            $products = Product::where('name', 'LIKE', "%{$query}%")->get();

            // Повернути результати на сторінку
            return view('search.search', compact('products'));
        }
}