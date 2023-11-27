<?php

namespace App\Services;

use App\Models\Organization;

class OrganizationService
{
    // CREATE
    public function store($attributes){
        $organization = $this->findOrganization($attributes);

        if(!isset($organization->id)){
            $organization = Organization::create([
                'organization_type_id' => $attributes['organization_type'],
                'name'                 => $attributes['organization_name']
            ]);
        }

        return $organization;
    }

    private function findOrganization($attributes){
        return Organization::where('organization_type_id', $attributes['organization_type'])
            ->where('name', $attributes['organization_name'])
            ->first();
    }
}
