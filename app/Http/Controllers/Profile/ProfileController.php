<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Profile;
use App\Services\PersonaldetailService;

// USE CASE CONTROLLER (PERSONAL DETAILS)
class ProfileController extends Controller
{
    private PersonaldetailService $personaldetailService;

    public function __construct() {
        $this->personaldetailService = new PersonaldetailService();
    }

    // CREATE
    public function create(){
        return view('profile.publishyourwork.personaldetails');
    }

    public function store(Request $request){ // store the users input, in the database, but not before validating them
        $this->personaldetailService->store($request);

        return redirect('/publish-your-work/organization')->with('success', 'Your Personal details have been stored successfully!');
    }

    public function update(Request $request, Profile $profile){
        $this->personaldetailService->update($request, $profile);

        return redirect('/publish-your-work/organization')->with('success', 'Your Personal details was successfully updated!');
    }
}
