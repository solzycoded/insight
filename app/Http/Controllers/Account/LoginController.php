<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;


class LoginController extends Controller
{
    // CREATE
    public function create(){
        return view('account.login.index');
    }
}
