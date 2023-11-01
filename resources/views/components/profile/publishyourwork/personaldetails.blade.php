@php
    $editLink = !is_null($profile->id) ? ('/' . $profile->id) : '';
@endphp

<x-profile.publishyourwork.section :step="1" :action="'/publish-your-work/personal-details' . $editLink" :method="'POST'" :type="(!empty($editLink) ? 'edit' : 'create')">

    <div style="max-width: 500px">
        <div>
            {{-- titles --}}
            <x-profile.publishyourwork.titles :display="'Title'" :value="$profile->title_id" />

            {{-- firstname input --}}
            <x-form.input type="text" placeholder="Enter your first name" maxlength="80" required :name="'first_name'" :display="'First Name'" value="{{ $profile->first_name }}" />

            {{-- lastname input --}}
            <x-form.input type="text" placeholder="Enter your last name" maxlength="80" required :name="'last_name'" :display="'Last Name'" value="{{ $profile->last_name }}" />
            
            {{-- lastname input --}}
            <x-form.input type="phone" placeholder="Enter your phone number" maxlength="14" required :name="'phone_number'" :display="'Phone Number'" value="{{ $profile->phone_number }}" />
            
            {{-- lastname input --}}
            <x-form.input type="text" placeholder="Enter your orcid id" maxlength="20" required :name="'orcid_id'" :display="'Orcid Id'" value="{{ $profile->orcid_id }}" />
        </div>

        <div style="max-width: 100px;">
            <x-form.submit-button>
                Next <i class="bi bi-arrow-right"></i>
            </x-form.submit-button>
        </div>
    </div>

</x-profile.publishyourwork.section>