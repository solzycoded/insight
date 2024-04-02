<?php 

namespace App\Services;

use App\Models\Manuscript;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class ManuscriptService extends PublishYourWorkService
{
    private ManuscriptFileService $manuscriptFileService;

    public function __construct() {
        $this->manuscriptFileService = new ManuscriptFileService;
    }
 
    // CREATE
    public function create(){
        $userAccessGranted = $this->allowAccess(4, 'profile.publishyourwork.manuscript');

        return $userAccessGranted;
    }

    public function store($request){
        // store manuscript details
        $manuscript = $this->createManuscript($request);

        // store manuscript file
        $this->manuscriptFileService->create($manuscript->id);

        // let the system be made aware that, a manuscript has been created and the user is ready to move to the next step
        $this->createSession($manuscript);
    }

    private function createManuscript($request){
        $attributes = $this->validateInput($request);

        $manuscript = Manuscript::firstOrCreate([
            'article_type_id' => $attributes['article_type'],
            'journal_id'      => session('journal')['id'],
            'title'           => $attributes['manuscript_title'],
            'abstract'        => $attributes['manuscript_abstract'],
            'user_id'         => auth()->user()->id,
            'status_id'       => (\App\Models\Status::firstWhere('name', 'pending')->id)
        ]);
 
        return $manuscript;
    }

    private function createSession($manuscript){
        session(['manuscript' => [
            'id'               => $manuscript->id, 
            'user_id'          => auth()->user()->id, 
            'selected_journal' => session('journal')['id']
        ]]);
    }

    // UPDATE
    public function update(Request $request, Manuscript $manuscript){
        // update manuscript
        $this->updateManuscript($request, $manuscript);

        // update manuscriptfile
        $this->manuscriptFileService->update($request, $manuscript->id);
    }

    private function updateManuscript($request, $manuscript){
        $attributes = $this->validateInput($request, $manuscript);

        $manuscript->title           = $attributes['manuscript_title'];
        $manuscript->article_type_id = $attributes['article_type'];
        $manuscript->title           = $attributes['manuscript_title'];
        $manuscript->abstract        = $attributes['manuscript_abstract'];

        $manuscript->save(); 
    }


    // OTHERS
    protected function validateInput($request, ?Manuscript $manuscript = null){
        $manuscript ??= new Manuscript();

        return $request->validate([
            'article_type'        => 'required|numeric|integer|exists:article_types,id',
            'manuscript_title'    => ['required', 'string', 'max:225', Rule::unique('manuscripts', 'title')->ignore($manuscript)],
            'manuscript_abstract' => 'required|string',
            'manuscript_file'     => (!isset($manuscript->id) ? 'required' : ('nullable' . (empty($request->file('manuscript_file')) ? '' : '|file'))),
            // 'supporting_files'    => 'nullable|array',
            // 'supporting_files.*'  => 'required|file|distinct',
        ]);
    }
}