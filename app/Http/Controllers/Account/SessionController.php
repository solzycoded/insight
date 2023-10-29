<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

//  FACADE controller X PURE FABRICATION??
class SessionController extends Controller
{
    // DELETE
    public function destroy(){ // logout the user from the system
        $profile = auth()->user()->profile;
        $name    = isset($profile->id) ? (', ' . $profile->title->name . ' ' . $profile->last_name) : '';

        auth()->logout();

        return redirect('/')->with('success', 'Goodbye ' . $name . '!');
    }
}
