<?php

namespace App\Http\Controllers\Profile;

use App\Models\Manuscript;

use App\Http\Controllers\Profile\ManuscriptFileController;

use Illuminate\Http\Request;

use App\Services\ManuscriptService;

class ManuscriptController extends PublishYourWorkController
{
    private ManuscriptService $manuscriptService;
    private ManuscriptFileController $manuscriptFileController;

    public function __construct() {
        $this->manuscriptService        = new ManuscriptService();
        $this->manuscriptFileController = new ManuscriptFileController();
    }

    // CREATE
    public function create(){
        $userAccessGranted = $this->allowAccess(4);

        // since the organization details isn't compulsory, we can proceed to journals
        if(is_bool($userAccessGranted)){
            return view('profile.publishyourwork.manuscript');
        }

        return $userAccessGranted;
    }

    public function store(Request $request){
        $manuscript = $this->manuscriptService->store($request);

        // store the manuscript files
        $this->manuscriptFileController->create($manuscript->id);

        return redirect('/publish-your-work/authors')->with('success', 'Your manuscript and it\'s details were saved successfully!');
    }

    // UPDATE
    public function update(Request $request, Manuscript $manuscript){
        $this->manuscriptService->update($request, $manuscript);

        // $this->manuscriptFileController->update($manuscript->id);

        return redirect('/publish-your-work/authors')->with('success', 'Your manuscript and it\'s details were successfully updated!');
    }
}
