<?php 

namespace App\Services;

use App\Models\Profile;
use Illuminate\Validation\Rule;

class PersonaldetailService
{
    // CREATE
    public function store($request){
        $attributes = $this->validateInput($request);

        // only create the new row, if the details don't exist
        Profile::firstOrCreate([
            'user_id'      => auth()->user()->id,
            'title_id'     => $attributes['title'],
            'first_name'   => $attributes['first_name'],
            'last_name'    => $attributes['last_name'],
            'phone_number' => $attributes['phone_number'],
            'orcid_id'     => $attributes['orcid_id'],
        ]);
    }

    // UPDATE
    public function update($request, $profile){
        $attributes = $this->validateInput($request, $profile);

        $profile->title_id     = $attributes['title'];
        $profile->first_name   = $attributes['first_name'];
        $profile->last_name    = $attributes['last_name'];
        $profile->phone_number = $attributes['phone_number'];
        $profile->orcid_id     = $attributes['orcid_id'];

        $profile->save();
    }

    // VALIDATION LOGIC
    protected function validateInput($request, ?Profile $profile = null): array{ // validate user input
        $profile ??= new Profile();

        return $request->validate([
            'title'        => 'required|numeric|integer|exists:titles,id',
            'first_name'   => 'required|string|max:80',
            'last_name'    => 'required|string|max:80',
            'phone_number' => ['required', 'numeric', 'integer', 'max_digits:14', Rule::unique('profiles', 'phone_number')->ignore($profile)],
            'orcid_id'     => ['required', 'numeric', 'integer', 'min_digits:16', 'max_digits:20', Rule::unique('profiles', 'orcid_id')->ignore($profile)]
        ]);
    }
}


