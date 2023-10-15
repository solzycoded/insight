<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public $fillable = [
        'organization_type_id', 'name'
    ];

    public $timestamps = false;

    // CHILDREN
    public function userOrganizations(){
        return $this->hasMany(UserOrganization::class);
    }

    // PARENT
    public function organizationType(){
        return $this->belongsTo(OrganizationType::class);
    }
}
