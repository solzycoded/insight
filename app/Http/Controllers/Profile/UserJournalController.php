<?php

namespace App\Http\Controllers\Profile;

use App\Models\Journal;

use Illuminate\Http\Request;

use App\Services\UserJournalService;

// use case controller
class UserJournalController extends PublishYourWorkController
{
    private UserJournalService $userJournalService;

    public function __construct() {
        $this->userJournalService = new UserJournalService();
    }

    // CREATE
    public function create(){
        $userAccessGranted = $this->allowAccess(3);

        // since the organization details isn't compulsory, we can proceed to journals
        if(is_bool($userAccessGranted)){
            return view('profile.publishyourwork.journal');
        }

        return $userAccessGranted;
    }

    public function store(Request $request){
        // the selected journal for the user, has to be stored in a session
        return $this->userJournalService->store($request);
    }

    public function update(Request $request, Journal $journal){
        return $this->userJournalService->update($request, $journal);
    }
}
