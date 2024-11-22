<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
