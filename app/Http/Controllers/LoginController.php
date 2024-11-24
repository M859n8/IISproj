<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
* Controller for login page
*/
class LoginController extends Controller{
    // User authentication
    public function loginClick(Request $request){
        // Value validation
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Start session
            $request->session()->regenerate();

            return redirect()->route('profile'); 
        }

        // If authentication fail
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // User logout 
    public function logout(Request $request)
    {
        Auth::logout();
        // Stop session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('main'); 
    }

}