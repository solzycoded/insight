<?php

namespace App\Http\Controllers\Profile;

use App\Models\UserOrganization;

use Illuminate\Http\Request;

use App\Services\UserOrganizationService;

class UserOrganizationController extends PublishYourWorkController
{
    private UserOrganizationService $userOrganizationService;

    public function __construct() {
        $this->userOrganizationService = new UserOrganizationService();
    }

    // CREATE
    public function create(){ // CHECK if the previous step (1), has already been filled, before proceeding to allow user create their organization

        // 1. return "true" if user has profile details, else return to the previous step
        $userAccessGranted = $this->allowAccess(2);

        // 2. proceed to step 2 (organization), if user has "profile" details
        if(is_bool($userAccessGranted)){
            return view('profile.publishyourwork.organization');
        }

        // 3. personal details for the user, doesn't exist, so they're prompted to fill it, before proceeding
        return $userAccessGranted;
    }

    public function store(Request $request){
        $this->userOrganizationService->store($request);

        return redirect('/publish-your-work/journal')->with('success', 'Your organization was stored successfully!');
    }

    // UPDATE
    public function update(Request $request, UserOrganization $userOrganization){
        $this->userOrganizationService->update($request, $userOrganization);

        return redirect('/publish-your-work/journal')->with('success', 'Your organization was successfully updated!');
    }
}
