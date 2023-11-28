<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManuscriptFile extends Model
{
    use HasFactory;

    public $fillable = [
        'manuscript_id', 'manuscript_file'
    ];

    public $timestamps = false;

    public function manuscript(){
        return $this->belongsTo(Manuscript::class);
    }

    // SCOPES
    public function filter($manuscriptId){
        return $this->where('manuscript_id', $manuscriptId)
            ->select(['manuscript_file', 'manuscript_files.id as id'])
            ->get();
    }
}
