<?php

namespace App\Services;

use App\Models\ManuscriptAuthor;

class ManuscriptAuthorService extends PublishYourWorkService
{
    // CREATE
    public function create(){
        $userAccessGranted = $this->allowAccess(5, 'profile.publishyourwork.authors');

        return $userAccessGranted;
    }

    public function store(){
        $attributes   = $this->validateInput();
        $manuscriptId = session('manuscript')['id'];

        // check if you need to update the manuscript authors, table
        $this->update($manuscriptId, $attributes);

        // store the authors
        foreach ($attributes['authors'] as $author) {
            $this->storeAuthor($author, $manuscriptId);
        }

        $this->setSession($attributes);
    }

    private function setSession($attributes){
        // proceed to tell the user that they're application was successful and is "pending review".
        session()->flash('success', 'Your application was successfully ' . (!$attributes['update'] ? 'submitted' : 'updated') . '!');

        // reset the journal and manuscript, so that the user has to start from scratch
        session()->forget(['journal', 'manuscript']);
    }

    private function storeAuthor($name, $manuscriptId){
        ManuscriptAuthor::firstOrCreate([
            'manuscript_id' => $manuscriptId,
            'name'          => $name
        ]);
    }

    // UPDATE
    private function update($manuscriptId, $attributes){
        $update = $attributes['update'];
        if($update){
            $this->destroy($manuscriptId, $attributes['authors']);
        }
    }

    // DELETE
    private function destroy($manuscriptId, $authors){
        ManuscriptAuthor::where('manuscript_id', $manuscriptId)
            ->whereNotIn('name', $authors)
            ->delete();
    }

    // VALIDATE AND ADJUST USER INPUT
    protected function validateInput(){
        // change the value of "update", if they meet certain requirements
        request()->merge([
            'update' => request('update')=='true' ? true : (request('update')=='false' ? false : request('update'))
        ]);

        // validate user input and return the value elements
        $attributes = request()->validate([
            'authors'   => 'nullable|array',
            'authors.*' => 'required|string|max:120',
            'update'    => 'required|boolean'
        ]);

        // initiate an "authors" key, if it doesn't exist
        if(!isset($attributes['authors'])){
            $attributes['authors'] = [];
        }

        return $attributes;
    }
}
