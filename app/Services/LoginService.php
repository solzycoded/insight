<?php

namespace App\Services;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

// USE CASE controller
class LoginService
{
    // log user into the system
    public function login($request){
        $attributes = $this->validateInput($request);

        // check if user credentials exists in the system
        if(Auth::attempt($attributes)){
            // to prevent an attack, via session
            session()->regenerate();

            // go the the profile page and tell the valid user "welcome back"
            return redirect('/profile')->with('success', 'Welcome Back, ' . auth()->user()->username . '!');
        }

        // authentication failed
        throw ValidationException::withMessages([
            'email' => 'Your provided credentials are invalid.'
        ]);
    }

    // OTHERS
    protected function validateInput($request){ // validate user input
        return $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|max:30'
        ]);
    }
}
