<x-profile.publishyourwork.section :step="1" :action="'/personal-details'" :method="'POST'">

    <div style="max-width: 500px">
        <div>
            {{-- titles --}}
            <x-profile.publishyourwork.titles :display="'Title'" />

            {{-- firstname input --}}
            <x-form.input type="text" placeholder="Enter your first name" maxlength="80" required :name="'first_name'" :display="'First Name'" />

            {{-- lastname input --}}
            <x-form.input type="text" placeholder="Enter your last name" maxlength="80" required :name="'last_name'" :display="'Last Name'" />
            
            {{-- lastname input --}}
            <x-form.input type="phone" placeholder="Enter your phone number" maxlength="14" required :name="'phone_number'" :display="'Phone Number'" />
            
            {{-- lastname input --}}
            <x-form.input type="text" placeholder="Enter your orcid id" maxlength="20" required :name="'orcid_id'" :display="'Orcid Id'" />
        </div>

        <div style="max-width: 100px;">
            <x-form.submit-button>
                Next <i class="bi bi-arrow-right"></i>
            </x-form.submit-button>
        </div>
    </div>

</x-profile.publishyourwork.section>