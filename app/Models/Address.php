<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $fillable = [
        'address_type_id', 'user_id', 'address', 'postal_code_id'
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function addressType(){
        return $this->belongsTo(AddressType::class);
    }

    public function postalCode(){
        return $this->belongsTo(PostalCode::class);
    }
}
