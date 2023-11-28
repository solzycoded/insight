<?php 

namespace App\Services;

use App\Models\ManuscriptFile;

use Illuminate\Support\Facades\File;

class ManuscriptFileService
{
    // CREATE
    public function create($manuscriptId){
        // store manuscript files and it's suppporting evidence
        $this->storeFiles('manuscript_file', 'file', $manuscriptId);
        // $this->storeFiles('supporting_files', 'supporting evidence', $manuscriptId);
    }

    private function store($file, $manuscriptId){
        ManuscriptFile::create([
            'manuscript_file'         => $file,
            'manuscript_id'           => $manuscriptId
        ]);
    }

    protected function storeFiles($name, $type, $manuscriptId){
        // check if the selected file exists on the device
        if(request()->hasFile($name)){
            $files      = request()->file($name); // store the files

            // IF the files are multiple (i.e. more than one), store each, one after the other
            if(is_array($files)){
                foreach ($files as $file) {
                    $this->storeFile($file, $type, $manuscriptId);
                }
            }
            else{ // ELSE if the file is a single file
                $this->storeFile($files, $type, $manuscriptId);
            }
        }
    }

    private function storeFile($file, $type, $manuscriptId){
        // store the file and return the url, to the file path
        $file = $file->store('manuscripts/' . $type);

        // store the record (file, manuscript id and file type) in the database
        $this->store($file, $manuscriptId);
    }

    // UPDATE
    public function update($request, $manuscriptId){
        $this->storeFiles('manuscript_file', 'file', $manuscriptId);
        
        if($request->hasFile('manuscript_file')){
            $this->destroy($manuscriptId);
        }
    }

    // DESTROY
    private function destroy($manuscriptId){
        // delete record from database
        $manuscriptFile     = ManuscriptFile::firstWhere('manuscript_id', $manuscriptId);
        $manuscriptFilePath = $manuscriptFile->manuscript_file; // get the file path from database

        $manuscriptFile->delete(); 

        // delete file from storage
        File::delete('storage/' . $manuscriptFilePath);
    }
}