<?php

namespace App\View\Components\profile\publishyourwork;

use Illuminate\View\Component;

use App\Models\Title;

class titles extends Component
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
        // get a list of all the titles (e.g. Mr, Mrs, etc.)
        $titles = Title::all();

        return view('components.profile.publishyourwork.titles', [
            'titles' => $titles
        ]);
    }
}
