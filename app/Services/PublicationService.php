<?php

namespace App\Services;

use App\Models\Manuscript;

class PublicationService
{
    // READ
    public function publications(){
        return Manuscript::where('user_id', auth()->user()->id)
            ->filter(request('status'))
            ->paginate(9);
    }

    // DELETE
    public function destroy($publication){
        $deleted = $publication->delete();

        return response()->json([
            'success' => $deleted
        ]);
    }
}
