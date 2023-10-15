<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationType extends Model
{
    use HasFactory;

    public $timestamps = false;

    // CHILDREN
    public function Organizations(){
        return $this->hasMany(Organizations::class);
    }
}
