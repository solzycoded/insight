<?php

namespace App\Http\Controllers\Profile;

use App\Models\Journal;

// use case controller
class UserJournalController extends PublishYourWorkController
{
    // CREATE
    public function create(){
        $userAccessGranted = $this->allowAccess(3);

        // since the organization details isn't compulsory, we can proceed to journals
        if(is_bool($userAccessGranted)){
            $journals = Journal::all();

            return view('profile.publishyourwork.journal', compact('journals'));
        }

        return $userAccessGranted;
    }

    public function store(){
        // the selected journal for the user, has to be stored in a session
        $attributes = $this->validateInput();
        session([
            'journal' => [
                'id'      => $attributes['journal_id'], 
                'user_id' => auth()->user()->id
            ]
        ]);

        return redirect('/publish-your-work/manuscript')->with('success', 'Your journal was saved successfully!');
    }

    // OTHERS
    protected function validateInput(){
        return request()->validate([
            'journal_id' => 'required|numeric|integer|exists:journals,id'
        ]);
    }
}
