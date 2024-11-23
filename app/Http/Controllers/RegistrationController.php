<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Модель користувача
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',

            // 'email' => 'required|email|max:255|unique:users,email,' . $request->email, // Перевіряємо, що новий email унікальний, крім поточного користувача
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Оновлюємо дані користувача
            $user->surname = $request->surname;
            $user->name = $request->name;
            $user->email = $request->email;
            
            // Зберігаємо зміни
            $user->save();
    
//             return view('profile');
            return redirect()->route('profile');
        }
        // $user = Auth::user();
        // $user->surname = $request->surname;
        // $user->name = $request->name;
        // $user->email = $request->email;
        
        // // Зберігаємо зміни
        // $user->save();


        // return redirect()->route('profile');
        
    }

    public function regProfile(Request $request){
        // Валідація даних
        $validator = Validator::make($request->all(), [
            'surname' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:users,email', // Перевірка унікальності
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:Farmer,Customer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();  // Повертає назад з помилками
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            return redirect()->back()->withErrors(['email' => 'User with this email exist.']);
        } else {
            // Якщо користувач не існує, створити нового
            $user = User::create([
                'surname' => $request->surname ?: null,

                'name' => $request->name,
                'email' => $request->email,
                // 'password' => $request->password,
                'password' => Hash::make($request->password), // Хешування пароля
                'role' => $request->role,
            ]);

            // Вхід після реєстрації
            Auth::login($user);
    
            // return view('profile', compact('user'));
            return redirect()->route('profile');
        }

        // return redirect()->route('profile')->with('success', 'Registration successful!');
    }

    // public function showProfile()
    // {
    //     $user = auth()->user(); // Отримати аутентифікованого користувача

    //     return view('profile', compact('user')); // Повертає дані у вигляді змінної $user у вигляді представлення profile.blade.php
    // }

}
