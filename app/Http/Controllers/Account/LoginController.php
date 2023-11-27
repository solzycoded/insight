<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Services\LoginService;

use Illuminate\Http\Request;

// USE CASE controller
class LoginController extends Controller
{
    private LoginService $loginService;

    public function __construct() {
        $this->loginService = new LoginService();
    }

    // CREATE
    public function create(){
        return view('account.login.index');
    }

    // CREATE
    public function login(Request $request){
        return $this->loginService->login($request);
    }
}
