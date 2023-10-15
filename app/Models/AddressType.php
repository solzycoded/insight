<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function addresses(){
        return $this->hasMany(Address::class);
    }
}
