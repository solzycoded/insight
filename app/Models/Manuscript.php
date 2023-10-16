<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manuscript extends Model
{
    use HasFactory;

    public $fillable = [
        'article_type_id', 'journal_id', 'title', 'abstract', 'user_id', 'status_id'
    ];

    // CHILDREN
    public function manuscriptFiles(){
        return $this->hasMany(ManuscriptFile::class);
    }

    // PARENTS
    public function articleType(){
        return $this->belongsTo(ArticleType::class);
    }

    public function journal(){
        return $this->belongsTo(Journal::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
