<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public $fillable = [
        'title_id', 'user_id', 'first_name', 'last_name', 'phone_number', 'orcid_id'
    ];

    public function title(){
        return $this->belongsTo(Title::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
