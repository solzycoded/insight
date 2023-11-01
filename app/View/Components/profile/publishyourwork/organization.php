<?php

namespace App\View\Components\profile\publishyourwork;

use Illuminate\View\Component;

class organization extends Component
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
        return view('components.profile.publishyourwork.organization', [
            'organization'      => $this->organization(),
            'organizationTypes' => \App\Models\OrganizationType::all()
        ]);
    }

    protected function organization(){
        $organization = auth()->user()->userOrganization;

        return isset($organization->id) ? $organization : new \App\Models\UserOrganization();
    }
}
