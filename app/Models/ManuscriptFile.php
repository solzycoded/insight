<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManuscriptFile extends Model
{
    use HasFactory;

    public $fillable = [
        'manuscript_id', 'manuscript_file', 'manuscript_file_type_id'
    ];

    public $timestamps = false;

    public function manuscript(){
        return $this->belongsTo(Manuscript::class);
    }

    public function manuscriptFileTypes(){
        return $this->belongsTo(ManuscriptFileType::class);
    }

    // SCOPES
    public function filter($manuscriptId, string $fileType){
        return $this->join('manuscript_file_types', 'manuscript_file_types.id', 'manuscript_files.manuscript_file_type_id')
            ->where('file_type', $fileType)
            ->where('manuscript_id', $manuscriptId)
            ->select(['manuscript_file', 'manuscript_file_type_id', 'manuscript_files.id as id'])
            ->get();
    }
}
