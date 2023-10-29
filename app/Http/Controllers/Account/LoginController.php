<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

// USE CASE controller
class LoginController extends Controller
{
    // CREATE
    public function create(){
        return view('account.login.index');
    }

    // CREATE
    public function store(){
        $attributes = $this->validateInput();

        // check if user credentials exists in the system
        if(Auth::attempt($attributes)){
            // to prevent an attack, via session
            session()->regenerate();

            // go the the profile page and tell the valid user "welcome back"
            return redirect('/profile')->with('success', 'Welcome Back!');
        }

        // authentication failed
        throw ValidationException::withMessages([
            'email' => 'Your provided credentials are invalid.'
        ]);
    }

    // OTHERS
    protected function validateInput(){ // validate user input
        return request()->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|max:30'
        ]);
    }
}
