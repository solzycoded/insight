<?php 

namespace App\Services;

use App\Models\Manuscript;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class ManuscriptService
{
    // CREATE
    public function store($request){
        $attributes = $this->validateInput($request);

        // store manuscript details
        $manuscript = Manuscript::create([
            'article_type_id' => $attributes['article_type'],
            'journal_id'      => session('journal')['id'],
            'title'           => $attributes['manuscript_title'],
            'abstract'        => $attributes['manuscript_abstract'],
            'user_id'         => auth()->user()->id,
            'status_id'       => (\App\Models\Status::firstWhere('name', 'pending')->id)
        ]);

        // let the system be made aware that, a manuscript has been created and the user is ready to move to the next step
        $this->createSession($manuscript);

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