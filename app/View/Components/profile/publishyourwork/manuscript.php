<?php

namespace App\View\Components\profile\publishyourwork;

use Illuminate\View\Component;

use App\Models\Manuscript as ManuscriptModel;

class manuscript extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $manuscript = $this->manuscript();

        return view('components.profile.publishyourwork.manuscript', [
            'articleTypes'              => \App\Models\ArticleType::all(),
            'journal'                   => \App\Models\Journal::find(session('journal')['id']),
            'manuscript'                => $manuscript,
            'manuscriptFile'            => $this->manuscriptFiles($manuscript),
        ]);
    }

    private function manuscript(){
        if(session()->has('manuscript') && isset(session('manuscript')['id'])){
            return ManuscriptModel::find(session('manuscript')['id']);
        }

        return new ManuscriptModel();
    }

    private function manuscriptFiles($manuscript){
        return isset($manuscript->manuscriptFiles[0]) ? (new \App\Models\ManuscriptFile())->filter($manuscript->id) : [];
    }
}
