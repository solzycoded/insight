<?php 

namespace App\Services;

use App\Models\Profile;
use Illuminate\Validation\Rule;

class PersonaldetailService
{
    // CREATE
    public function store($request){
        $this->createPersonalDetails($request);
    }

    private function createPersonalDetails($request){
        $attributes = $this->validateInput($request);

        // only create the new row, if the details don't already exist
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

        $profile->update($attributes);
    }

    // VALIDATION LOGIC
    protected function validateInput($request, ?Profile $profile = null): array{ // validate user input
        $profile ??= new Profile();

        return $request->validate([
            'title'        => 'required|numeric|integer|exists:titles,id',
            'first_name'   => 'required|string|max:80',
            'last_name'    => 'required|string|max:80',
            'phone_number' => ['required', 'numeric', 'integer', 'digits:13', Rule::unique('profiles', 'phone_number')->ignore($profile)],
            'orcid_id'     => ['nullable', 'numeric', 'integer', 'min_digits:16', 'max_digits:20', Rule::unique('profiles', 'orcid_id')->ignore($profile)]
        ]);
    }
}

