<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use App\Models\Journal;

use Illuminate\Http\Request;

use App\Services\UserJournalService;

// USE CASE controller
class UserJournalController extends Controller
{
    private UserJournalService $userJournalService;

    public function __construct() {
        $this->userJournalService = new UserJournalService();
    }

    // CREATE
    public function create(){
        return $this->userJournalService->create();
    }

    public function store(Request $request){
        // the selected journal for the user, has to be stored in a session
        return $this->userJournalService->store($request);
    }

    public function update(Request $request, Journal $journal){
        return $this->userJournalService->update($request, $journal);
    }
}
