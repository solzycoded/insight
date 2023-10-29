<?php

namespace App\Http\Controllers\Profile;

use App\Models\ArticleType;
use App\Models\Journal;
use App\Models\Manuscript;

use App\Http\Controllers\Profile\ManuscriptFileController;

class ManuscriptController extends PublishYourWorkController
{
    // CREATE
    public function create(){
        $userAccessGranted = $this->allowAccess(4);

        // since the organization details isn't compulsory, we can proceed to journals
        if(is_bool($userAccessGranted)){
            $articleTypes = ArticleType::all();
            $journal      = Journal::find(session('journal')['id']);

            return view('profile.publishyourwork.manuscript', compact('articleTypes', 'journal'));
        }

        return $userAccessGranted;
    }

    public function store(){
        $attributes = $this->validateInput();

        // store manuscript details
        $manuscript = Manuscript::create([
            'article_type_id' => $attributes['article_type'],
            'journal_id'      => session('journal')['id'],
            'title'           => $attributes['manuscript_title'],
            'abstract'        => $attributes['manuscript_abstract'],
            'user_id'         => auth()->user()->id,
            'status_id'       => (\App\Models\Status::firstWhere('name', 'pending')->id)
        ]);

        // store the manuscript files
        (new ManuscriptFileController())->create($manuscript->id);

        // let the system be made aware that, a manuscript has been created and the user is ready to move to the next step
        session(['manuscript' => [
            'id'               => $manuscript->id, 
            'user_id'          => auth()->user()->id, 
            'selected_journal' => session('journal')['id']
        ]]);

        return redirect('/publish-your-work/authors')->with('success', 'Your manuscript and it\'s details were saved successfully!');
    }

    // OTHERS
    protected function validateInput(){
        return request()->validate([
            'article_type'        => 'required|numeric|integer|exists:article_types,id',
            'manuscript_title'    => 'required|string|max:225|unique:manuscripts,title',
            'manuscript_abstract' => 'required|string',
            'manuscript_file'     => 'required|file',
            'supporting_files'    => 'nullable|array',
            'supporting_files.*'  => 'required|file|distinct',
        ]);
    }
}
