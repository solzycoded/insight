<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\Services\SessionService;

//  FACADE controller X PURE FABRICATION??
class SessionController extends Controller
{
    private SessionService $sessionService;

    public function __construct() {
        $this->sessionService = new SessionService();
    }

    // DELETE
    public function destroy(){ // log the user out of the system
        $response = $this->sessionService->destroy();

        return redirect('/')->with('success', $response);
    }
}
