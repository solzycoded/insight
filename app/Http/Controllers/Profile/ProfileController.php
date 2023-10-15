<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use App\Models\Profile;
use App\Models\Title;

class ProfileController extends Controller
{
    // CREATE
    public function create(){
        // get a list of all the titles (e.g. Mr, Mrs, etc.)
        $titles = Title::all();

        return view('profile.publishyourwork.personaldetails', compact('titles'));
    }

    public function store(){ // store the users input, in the database, but not before validating them
        $attributes = $this->validateInput();

        // only create the new row, if the details don't exist
        Profile::firstOrCreate([
            'user_id'      => auth()->user()->id,
            'title_id'     => $attributes['title'],
            'first_name'   => $attributes['first_name'],
            'last_name'    => $attributes['first_name'],
            'phone_number' => $attributes['phone_number'],
            'orcid_id'     => $attributes['orcid_id'],
        ]);

        return redirect('/publish-your-work/organization')->with('success', 'Your Personal details have been stored successfully!');
    }

    // OTHERS
    protected function validateInput(){ // validate user input
        return request()->validate([
            'title'        => 'required|numeric|integer|exists:titles,id',
            'first_name'   => 'required|string|max:80',
            'last_name'    => 'required|string|max:80',
            'phone_number' => 'required|numeric|integer|max_digits:14|unique:profiles,phone_number',
            'orcid_id'     => 'required|numeric|integer|min_digits:16|max_digits:20|unique:profiles,orcid_id',
        ]);
    }
}
