<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $fillable = [
        'name'
    ];

    // CHILDREN
    public function manuscripts(){
        return $this->hasMany(Manuscript::class);
    }
}
