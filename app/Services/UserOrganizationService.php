<?php 

namespace App\Services;

use App\Models\UserOrganization;

use App\Http\Controllers\Profile\OrganizationController;

class UserOrganizationService
{
    // CREATE
    public function store($request){
        $attributes = $this->validateInput($request);

        // STORE THE ORGANIZATION'S DETAILS

        // 1. create a new organization along with it's type or return the record, if it already exists
        $organization = $this->storeOrganization($attributes);

        // 2. store the user's position, in the recently created organization
        UserOrganization::firstOrCreate([
            'user_id'         => auth()->user()->id,
            'organization_id' => $organization->id,
            'position'        => $attributes['position']
        ]);
    }

    // UPDATE
    public function update($request, $userOrganization){
        $attributes = $this->validateInput($request);

        // create organization or return the existing organization, if it already exists
        $organization = $this->storeOrganization($attributes);

        $userOrganization->organization_id      = $organization->id;
        $userOrganization->position             = $attributes['position'];

        $userOrganization->save();
    }

    private function storeOrganization($attributes){ // create organization
        return (new OrganizationController())->store($attributes);
    }

    // VALIDATION LOGIC
    protected function validateInput($request){
        return $request->validate([
            'organization_type' => 'required|numeric|integer|exists:organization_types,id',
            'organization_name' => 'required|string|max:200',
            'position'          => 'nullable|string|max:120'
        ]);
    }
}
