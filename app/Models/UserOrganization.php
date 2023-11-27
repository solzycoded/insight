<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrganization extends Model
{
    use HasFactory;

    public $fillable = [
        'organization_id', 'user_id', 'position'
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
