<?php

namespace App\View\Components\profile\publishyourwork;

use Illuminate\View\Component;

class authors extends Component
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
        return view('components.profile.publishyourwork.authors', [
            'authors' => $this->authors()
        ]);
    }

    private function authors(){
        if(session()->has('manuscript') && isset(session('manuscript')['id'])){
            $authors = \App\Models\Manuscript::find(session('manuscript')['id'])->manuscriptAuthors;

            return $authors;
        }

        return [];
    }
}
