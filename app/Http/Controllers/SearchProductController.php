<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class SearchProductController extends Controller
{
    //function that shows all information for search page 
    public function search(Request $request)
    {
        //get categories
        $categories = Category::where('status', 'Approved')->get();
        //category tree
        $tree = $this->buildTree($categories);

        $productsQuery = Product::query();
        //get farmers
        $users = User::all();
        $farmers = $users->where('role', 'LIKE', "Farmer");
        //if search by product name
        $query = $request->input('query');
        if ($query) {
            $productsQuery->where('name', 'LIKE', "%{$query}%");
        }

        //if selected category
        $categoryId = $request->input('category');
        if ($categoryId) {
            $productsQuery->whereHas('category', function ($subQuery) use ($categoryId) {
                $subQuery->where('categories.id', $categoryId);
            });
        }
        //if selected farmer
        $farmerId = $request->input('farmer');
        if ($farmerId) {
            $productsQuery->where('user_id', $farmerId);
        }
        //if selected sort by price
        if ($request->filled('sort_order')) {
            $productsQuery->orderBy('price', $request->input('sort_order') === 'desc' ? 'desc' : 'asc');
        }


        $products = $productsQuery->get();

        //return filtered products, category tree, farmerlist
        return view('search', ['categories' => $tree, 'products' => $products, 'farmers' => $farmers]);
    }
    
    //build category tree
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