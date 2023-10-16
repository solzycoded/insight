<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use App\Models\OrganizationType;
use App\Models\UserOrganization;

class UserOrganizationController extends Controller
{
    // CREATE
    public function create(){
        // CHECK if the previous step (1), has already been filled, before proceeding to allow user create their organization

        // 1. return "true" if user has profile details, else return false and store it in "hasProfile"
        $hasProfile = isset(auth()->user()->profile->id);

        // 2. proceed to step 2 (organization), if user has "profile" details
        if($hasProfile){
            $organizationTypes = OrganizationType::all();

            return view('profile.publishyourwork.organization', compact('organizationTypes'));
        }

        // 3. personal details for the user, doesn't exist, so they're prompted to fill it, before proceeding
        return redirect('/publish-your-work/personal-details')->with('success', 'Kindly provide your personal details! You can\'t skip Step 1.');
    }

    public function store(){
        $attributes       = $this->validateInput();

        // STORE THE ORGANIZATION'S DETAILS
        $userOrganization = new UserOrganization();

        // 1. create a new organization along with it's type or return the record, if it already exists
        $organization     = $userOrganization->organization()->firstOrCreate([
            'organization_type_id' => $attributes['organization_type'],
            'name'                 => $attributes['organization_name']
        ]);

        // 2. store the user's position, in the recently created organization
        $userOrganization->firstOrCreate([
            'user_id'         => auth()->user()->id,
            'organization_id' => $organization->id,
            'position'        => $attributes['position']
        ]);

        return redirect('/publish-your-work/address')->with('success', 'Your organization was stored successfully!');
    }

    // OTHERS
    protected function validateInput(){
        return request()->validate([
            'organization_type' => 'required|numeric|integer|exists:organization_types,id',
            'organization_name' => 'required|string|max:200',
            'position'          => 'nullable|string|max:120'
        ]);
    }
}
