<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManuscriptFileType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function manuscriptFiles(){
        return $this->hasMany(ManuscriptFile::class);
    }
}
