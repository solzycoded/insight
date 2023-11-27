<?php

namespace App\View\Components\profile\mypublications;

use App\Http\Controllers\Profile\ManuscriptController;
use App\Http\Controllers\Profile\PublicationController;
use Illuminate\View\Component;

class index extends Component
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
        return view('components.profile.mypublications.index', [
            'publications' => $this->publications(),
            'statusList'   => $this->statusList()
        ]);
    }

    private function publications(){
        return (new PublicationController())->publications();
    }

    private function statusList(){
        return ['pending' => 'secondary', 'rejected' => 'danger', 'approved' => 'success', 'under review' => 'warning'];
    }
}
