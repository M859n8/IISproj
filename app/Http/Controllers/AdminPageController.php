<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;

/*
* Controller for page created specially for administrator
*/
class AdminPageController extends Controller
{
    // Show list of users
    public function index()
    {
        $users = User::all(); // Get all users
        return view('userlist', compact('users'));
    }

    // Delete user from database
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Search for this user in DB
        $user->delete(); 

        return redirect()->route('users.list')->with('success', 'User deleted successfully.');
    }

    // Show the list of categories, that  waiting for approval
    public function showCategories()
    {
        $categories = Category::where('status', 'Not approved')->get();
        return view('categorylist', compact('categories'));
    }

    // Approve category
    public function approveCategory($id)
    {
        $category = Category::findOrFail($id);
        // Change status
        $category->update(['status' => 'Approved']);

        return redirect()->back()->with('success', 'Category approved successfully.');
    }

    // Delete category from DB
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
