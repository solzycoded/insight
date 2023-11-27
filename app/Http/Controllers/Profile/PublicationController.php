<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use App\Models\Manuscript;

use Illuminate\Http\Request;

use App\Services\PublicationService;

class PublicationController extends Controller
{
    private PublicationService $publicationService;

    public function __construct() {
        $this->publicationService = new PublicationService();
    }

    // READ
    public function index(){
        return view('profile.mypublications.index');
    }

    public function publications(){
        return $this->publicationService->publications();
    }

    // DELETE
    public function destroy(Request $request, Manuscript $publication){
        return $this->publicationService->destroy($publication);
    }
}
