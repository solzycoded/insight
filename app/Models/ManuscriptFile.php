<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManuscriptFile extends Model
{
    use HasFactory;

    public $fillable = [
        'manuscript_id', 'file', 'manuscript_file_type_id'
    ];

    public $timestamps = false;

    public function manuscript(){
        return $this->belongsTo(Manuscript::class);
    }

    public function manuscriptFileTypes(){
        return $this->belongsTo(ManuscriptFileType::class);
    }
}
