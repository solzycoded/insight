<?php

namespace App\Services;

use App\Models\Journal;

class UserJournalService extends PublishYourWorkService
{
    // CREATE
    public function create(){
        return $this->allowAccess(3, 'profile.publishyourwork.journal');
    }

    public function store($request){
        // the selected journal for the user, has to be stored in a session
        return $this->storeJournalAsSession($request, 'The journal you selected was saved successfully!');
    }

    public function update($request, Journal $journal){
        if($journal->id==session('journal')['id']){
            return $this->storeJournalAsSession($request, 'The selected journal was successfully updated!');
        }

        return back()->with('success', 'Your selection was Invalid');
    }

    private function storeJournalAsSession($request, $successMsg){
        $attributes = $this->validateInput($request);
        session([
            'journal' => [
                'id'      => $attributes['journal_id'], 
                'user_id' => auth()->user()->id
            ]
        ]);

        return redirect('/publish-your-work/manuscript')->with('success', $successMsg);
    }

    // VALIDATION LOGIC
    protected function validateInput($request): array{ // validate user input
        return $request->validate([
            'journal_id' => 'required|numeric|integer|exists:journals,id'
        ]);
    }
}


