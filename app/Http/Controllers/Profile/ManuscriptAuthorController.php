<?php

namespace App\Http\Controllers\Profile;

use App\Models\ManuscriptAuthor;

class ManuscriptAuthorController extends PublishYourWorkController
{
    // CREATE
    public function create(){
        $userAccessGranted = $this->allowAccess(5);

        // since the organization details isn't compulsory, we can proceed to journals
        if(is_bool($userAccessGranted)){
            return view('profile.publishyourwork.authors');
        }

        return $userAccessGranted;
    }

    public function store(){
        $attributes   = $this->validateInput();
        $manuscriptId = session('manuscript')['id'];

        // store the authors
        foreach ($attributes['authors'] as $author) {
            $this->storeAuthor($author['name'], $manuscriptId);
        }

        // proceed to tell the user that they're application was successful and is "pending review".
        session()->flash('success', 'Your application was successfully submitted!');
        return response()->json([
            'success' => true
        ]);
    }

    private function storeAuthor($name, $manuscriptId){
        ManuscriptAuthor::create([
            'manuscript_id' => $manuscriptId,
            'name'          => $name
        ]);
    }

    // OTHERS
    protected function validateInput(){
        return request()->validate([
            'authors.*'      => 'nullable|array:name',
            'authors.*.name' => 'required|string|max:120'
        ]);
    }
}
