<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function manuscripts(){
        return $this->hasMany(Manuscript::class);
    }
}
