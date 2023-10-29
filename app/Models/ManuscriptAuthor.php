<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManuscriptAuthor extends Model
{
    use HasFactory;

    public $fillable = [
        'manuscript_id', 'name'
    ];

    public $timestamps = false;

    public function manuscript(){
        return $this->belongsTo(Manuscript::class);
    }
}
