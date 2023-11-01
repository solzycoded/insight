<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

// USE CASE and FACADE controller
class PublishYourWorkController extends Controller
{
    // control user access each for each step
    public function allowAccess($step){
        return $this->steps($step);
    }

    private function steps($step){
        switch ($step) {
            case 2: // check if user has their personal details stored
                $hasProfile = !is_null(auth()->user()->profile);

                if(!$hasProfile){
                    return $this->pageRedirect('personal-details', 'Kindly provide your personal details! You can\'t skip Step 1.');
                }

                return true;

            case 3: // check if user has an organization stored
                $hasOrganization = !is_null(auth()->user()->userOrganization);

                if(!$hasOrganization){
                    return $this->pageRedirect('organization', 'Kindly provide your organization details! You can\'t skip Step 2.');
                }

                return $this->steps(2);

            case 4: // check if user has journal saved
                $hasSelectedJournal = $this->hasSelectedJournal();

                if($hasSelectedJournal){
                    $manuscriptId          = session('journal')['id'];
                    $hasSelectedJournal = \App\Models\Journal::where('id', $manuscriptId)->exists();
                }

                if(!$hasSelectedJournal){
                    return $this->pageRedirect('journal', 'Kindly select a journal to publish in! You can\'t skip Step 3.');
                }

                return $this->steps(3);

            case 5: // check if user has an journal AND manuscript saved
                $hasStoredManuscript = $this->hasStoredManuscript();

                if($hasStoredManuscript){
                    $manuscriptId        = session('manuscript')['id'];
                    $manuscript          = \App\Models\Manuscript::find($manuscriptId);

                    $hasStoredManuscript = isset($manuscript->id) && $manuscript->user_id==auth()->user()->id;
                }

                if(!$hasStoredManuscript){
                    return $this->pageRedirect('manuscript', 'Kindly provide your Manuscript Details! You can\'t skip Step 4.');
                }

                return $this->steps(4);

            default:
                return true;
        }
    }

    private function pageRedirect($destination, $message){
        return redirect('/publish-your-work/' . $destination)->with('success', $message);
    }

    public function hasStoredManuscript(){
        // make sure that journal and manuscript sessions, exist
        // make sure that the user_id and stored journals are the same, for both the "journal and manuscript sessions"
        return (session()->has('journal') && session()->has('manuscript')) && 
        (session('journal')['user_id']==session('manuscript')['user_id']) && 
        (session('journal')['id']==session('manuscript')['selected_journal']) && 
        isset(session('manuscript')['id']);
    }

    public function hasSelectedJournal(){
        return session()->has('journal') && session('journal')['user_id']==auth()->user()->id;
    }
}
