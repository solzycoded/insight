<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // MUTATOR
    public function setPasswordAttribute($password){
        $this->attributes['password'] = bcrypt($password);
    }

    // CHILDREN
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function userOrganization(){
        return $this->hasOne(UserOrganization::class);
    }

    public function manuscripts(){
        return $this->hasMany(Manuscript::class);
    }
}