<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;

    public $fillable = [
        'city_id', 'postal_code'
    ];

    public $timestamps = false;

    // PARENTS
    public function city(){
        return $this->belongsTo(City::class);
    }

    // CHILDREN
    public function addresses(){
        return $this->hasMany(Address::class);
    }
}
