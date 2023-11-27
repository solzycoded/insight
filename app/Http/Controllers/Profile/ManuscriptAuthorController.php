<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use App\Services\ManuscriptAuthorService;

class ManuscriptAuthorController extends Controller
{
    private ManuscriptAuthorService $manuscriptAuthorService;

    public function __construct() {
        $this->manuscriptAuthorService = new ManuscriptAuthorService();
    }

    // CREATE
    public function create(){
        return $this->manuscriptAuthorService->create();
    }

    public function store(){
        $this->manuscriptAuthorService->store();

        return response()->json([
            'success' => true
        ]);
    }
}
