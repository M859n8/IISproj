<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

/*
* Controller for page where users can create new category
*/
class CategoryController extends Controller
{
    // Show the list of possible parent category
    public function showCategories()
    {
        // Get only approved categories for selecting a parent category
        $categories = Category::where('status', 'Approved')->get();

        return view('createcategory', compact('categories'));
    }

    // Create new category
    public function create(Request $request)
    {
        // Check
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',
        ], [
            'name.unique' => 'Category with this name already exists.',
        ]);

        $user = auth()->user();
        // If user is not admin - category will wait for the approval
        if($user->role === 'Admin'){
            $status = 'Approved';
        } else {
            $status = 'Not approved';
        }

        Category::create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'status' => $status,
        ]);

        return redirect()->back()->with('success', 'Category created successfully.');
    }

}
