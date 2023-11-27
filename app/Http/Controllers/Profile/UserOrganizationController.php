<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use App\Models\UserOrganization;

use Illuminate\Http\Request;

use App\Services\UserOrganizationService;

// USE CASE and FACADE controller
class UserOrganizationController extends Controller
{
    private UserOrganizationService $userOrganizationService;

    public function __construct() {
        $this->userOrganizationService = new UserOrganizationService();
    }

    // CREATE
    public function create(){ // CHECK if the previous step (1), has already been filled, before proceeding to allow user create their organization
        return $this->userOrganizationService->create();
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
