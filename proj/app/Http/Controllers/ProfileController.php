<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Модель користувача
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //треба буде реалізувати оновлення на осонові бд
    public function update(Request $request)
    {
        // // Логіка оновлення профілю
        return redirect()->back()->with('status', 'Profile updated!');
        
    }

    public function regProfile(Request $request){
        // Валідація даних
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Перевірка унікальності
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Створення нового користувача
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            // 'password' => Hash::make($request->password), // Хешування пароля
        ]);

        return redirect()->route('profile')->with('success', 'Registration successful!');
    }
}
