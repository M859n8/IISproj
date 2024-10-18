<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Модель користувача
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    public function loginClick(Request $request){
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($request->password === $user->password) {
                // Якщо користувач існує і пароль вірний, показати профіль користувача(вью профайл), передавши данні з дата бази цього юзера
                return view('profile', compact('user'));
            } else {
                // Якщо пароль невірний, повернути на форму з повідомленням
                return redirect()->back()->withErrors(['password' => 'Incorrect password. try again']);
            }
        } else {
            //Випиши помилку прямо поверх форми, що такого користувача не існує
            return redirect()->back()->withErrors(['email' => 'User with this email does not exist.']);
        }
    }

}