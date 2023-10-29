<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\User;

// USE CASE controller
class SignupController extends Controller
{
    // CREATE
    public function create(){
        return view('account.signup.index');
    }

    public function store(){
        $attributes = $this->validateInput();

        // create user
        $user = User::create([
            'email'    => $attributes['email'],
            'password' => $attributes['password']
        ]);

        // login the user into the system
        auth()->login($user);

        return redirect('/profile')->with('success', 'Your account has been created');
    }

    // OTHERS
    protected function validateInput(){ // validate user input
        return request()->validate([
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|max:30',
            're_password' => 'required|string|same:password',
        ]);
    }
}
