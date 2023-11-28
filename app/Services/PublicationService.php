<?php

namespace App\Services;

use App\Models\Manuscript;

class PublicationService
{
    // READ
    // get a list of publications, which belong to the currently logged in user
    public function publications(){
        return Manuscript::where('user_id', auth()->user()->id)
            ->filter(request('status'))
            ->paginate(9);
    }

    // DELETE
    public function destroy($publication){
        return $publication->delete();
    }
}
