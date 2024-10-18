<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Модель користувача
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
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
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email', // Перевірка унікальності
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->back()->withErrors(['email' => 'User with this email exist.']);
        } else {
            // Якщо користувач не існує, створити нового
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                // 'password' => Hash::make($request->password), // Хешування пароля
            ]);
    
            return view('profile', compact('user'));
        }

        // return redirect()->route('profile')->with('success', 'Registration successful!');
    }

    // public function showProfile()
    // {
    //     $user = auth()->user(); // Отримати аутентифікованого користувача

    //     return view('profile', compact('user')); // Повертає дані у вигляді змінної $user у вигляді представлення profile.blade.php
    // }

}
