<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //треба буде реалізувати оновлення на осонові бд
    public function update(Request $request)
    {
        // Логіка оновлення профілю
        return redirect()->back()->with('status', 'Profile updated!');
    }
}
