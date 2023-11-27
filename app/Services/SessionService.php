<?php

namespace App\Services;

class SessionService
{
    // DELETE
    public function destroy(){ // logout the user from the system
        $username = auth()->user()->username;

        auth()->logout();

        return 'Goodbye ' . $username . '!';
    }
}
