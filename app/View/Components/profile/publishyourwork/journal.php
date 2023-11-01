<?php

namespace App\View\Components\profile\publishyourwork;

use Illuminate\View\Component;

class journal extends Component
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
        return view('components.profile.publishyourwork.journal', [
            'journals' => \App\Models\Journal::all()
        ]);
    }
}
