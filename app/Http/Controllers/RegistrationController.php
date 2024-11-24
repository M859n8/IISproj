<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

/*
* Controller for registration page and updating user information
*/
class RegistrationController extends Controller
{
    // Update user information
    public function update(Request $request)
    {
        $request->validate([
            'surname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user(); // get user from session
        $user->surname = $request->surname;
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Save changes
        $user->save();

        return redirect()->route('profile');
        
    }

    //Create the user if they do not exist
    public function regProfile(Request $request){
        // Validation
        $validator = Validator::make($request->all(), [
            'surname' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:Farmer,Customer',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();  // Get back with error
        }
        // Try to find user in DB
        $user = User::where('email', $request->email)->first();

        if ($user) { 
            return redirect()->back()->withErrors(['email' => 'User with this email exist.']);
        } else {
            // Create new user
            $user = User::create([
                'surname' => $request->surname ?: null,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            // Start session
            Auth::login($user);

            return redirect()->route('profile');
        }

    }

}
