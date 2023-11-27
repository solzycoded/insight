<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Services\SignupService;

use Illuminate\Http\Request;

// USE CASE controller
class SignupController extends Controller
{
    // initialize the service class
    private SignupService $signupService;

    public function __construct() {
        $this->signupService = new SignupService();
    }

    // CREATE
    public function create(){ // display the "signup" view
        return view('account.signup.index');
    }

    // get the user's request, pass it to the sign up service. The "store" function, in the signup service, will
    // a. validate the user input
    // b. create new user
    // c. log user into the system
    public function store(Request $request){
        $user = $this->signupService->store($request);

        return redirect('/profile')->with('success', 'Your account has been created. Welcome to Insight, ' . $user->username);
    }
}
