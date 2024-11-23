<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    // Відображення списку користувачів
    public function index()
    {
        $users = User::all(); // Отримати всіх користувачів
        return view('userlist', compact('users'));
    }

    // Видалення користувача
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Знайти користувача або викинути помилку
        $user->delete(); // Видалити користувача

        return redirect()->route('users.list')->with('success', 'User deleted successfully.');
    }

    // Відображення категорій, що чекають на схвалення
    public function showCategories()
    {
        $categories = Category::where('status', 'Not approved')->get();
        return view('categorylist', compact('categories'));
    }

    // Схвалення категорії
    public function approveCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['status' => 'Approved']);

        return redirect()->back()->with('success', 'Category approved successfully.');
    }

    // Видалення категорії
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
