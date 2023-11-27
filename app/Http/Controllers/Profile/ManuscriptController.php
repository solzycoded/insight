<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use App\Models\Manuscript;

use Illuminate\Http\Request;

use App\Services\ManuscriptService;

class ManuscriptController extends Controller
{ 
    private ManuscriptService $manuscriptService;

    public function __construct() {
        $this->manuscriptService = new ManuscriptService();
    }

    // CREATE
    public function create(){
        return $this->manuscriptService->create();
    }

    public function store(Request $request){
        $this->manuscriptService->store($request);

        return redirect('/publish-your-work/authors')->with('success', 'Your manuscript and it\'s details were saved successfully!');
    }

    // UPDATE
    public function update(Request $request, Manuscript $manuscript){
        $this->manuscriptService->update($request, $manuscript);

        return redirect('/publish-your-work/authors')->with('success', 'Your manuscript and it\'s details were successfully updated!');
    }
}
