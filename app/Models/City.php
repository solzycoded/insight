<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $fillable = [
        'country_id', 'name'
    ];

    public $timestamps = false;

    // PARENTS
    public function country(){
        return $this->belongsTo(Country::class);
    }

    // CHILDREN
    public function postalCodes(){
        return $this->hasMany(PostalCode::class);
    }
}
