<?php

namespace App\Services;

use App\Models\User;

class SignupService
{
    // CREATE
    public function store($request){
        // create user
        $user = $this->createUser($request);

        // login the user into the system
        auth()->login($user);

        return $user;
    }

    private function createUser($request){
        $attributes = $this->validateInput($request);

        return User::firstOrCreate([
            'email'    => $attributes['email'],
            'password' => $attributes['password'],
            'username' => $attributes['username']
        ]);
    }

    // OTHERS
    protected function validateInput($request){ // validate user input
        return $request->validate([
            'email'       => 'required|email|unique:users,email|max:120',
            'username'    => 'required|string|unique:users,username|max:100',
            'password'    => 'required|string|max:30',
            're_password' => 'required|string|same:password',
        ]);
    }
}
