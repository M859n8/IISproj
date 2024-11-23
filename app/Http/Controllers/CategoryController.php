<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function showCategories()
    {
        // Отримати лише затверджені категорії для вибору надкатегорії
        $categories = Category::where('status', 'Approved')->get();

        return view('createcategory', compact('categories'));
    }

    public function create(Request $request)
    {
        // Валідація
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',
        ], [
            'name.unique' => 'Category with this name already exists.',
        ]);
        $user = auth()->user();
        if($user->role === 'Admin'){
            $status = 'Approved';
        } else {
            $status = 'Not approved';
        }

        // Створення категорії
        Category::create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Category created successfully.');
    }

}
