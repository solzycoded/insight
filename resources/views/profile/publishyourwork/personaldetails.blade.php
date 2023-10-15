<x-layout>
    @include ('._header')

    <x-profile.publishyourwork.section :step="1" :action="'/personal-details'" :method="'POST'">

        <div style="max-width: 500px">
            <div>
                {{-- titles --}}
                <div>
                    <label for="title" class="fw-bold">Title</label>
                    <select class="form-select form-select-md mb-3 text-capitalize" aria-label=".form-select-md" id="title" name="title" required>
                        <option selected disabled>Select your title</option>
                        @foreach ($titles as $title)
                            <option value="{{ $title->id }}" {{ (old('title')==$title->id ? 'selected' : '') }}>{{ $title->name }}</option>
                        @endforeach
                    </select>
                </div>

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
</x-layout>