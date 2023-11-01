<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use App\Models\ManuscriptFile;
use App\Models\ManuscriptFileType;

class ManuscriptFileController extends Controller
{
    // CREATE
    public function create($manuscriptId){
        // store manuscript files and it's suppporting evidence
        $this->storeFiles('manuscript_file', 'file', $manuscriptId);
        // $this->storeFiles('supporting_files', 'supporting evidence', $manuscriptId);
    }

    private function store($file, $manuscriptId, $fileTypeId){
        ManuscriptFile::create([
            'manuscript_file'         => $file,
            'manuscript_id'           => $manuscriptId,
            'manuscript_file_type_id' => $fileTypeId
        ]);
    }

    protected function storeFiles($name, $type, $manuscriptId){
        // check if the selected file exists on the device
        if(request()->hasFile($name)){
            $files      = request()->file($name); // store the files
            $fileTypeId = ManuscriptFileType::firstWhere('file_type', $type)->id;

            // IF the files are multiple (i.e. more than one), store each, one after the other
            if(is_array($files)){
                foreach ($files as $file) {
                    $this->storeFile($file, $type, $manuscriptId, $fileTypeId);
                }
            }
            else{ // ELSE if the file is a single file
                $this->storeFile($files, $type, $manuscriptId, $fileTypeId);
            }
        }
    }

    private function storeFile($file, $type, $manuscriptId, $fileTypeId){
        // store the file and return the url, to the file path
        $file = $file->store('manuscripts/' . $type);

        $this->store($file, $manuscriptId, $fileTypeId);
    }
}
