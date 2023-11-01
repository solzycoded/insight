@php
    $editLink = !is_null($organization->id) ? ('/' . $organization->id) : '';
@endphp

<x-profile.publishyourwork.section :step="2" :action="'/publish-your-work/organization' . $editLink" :method="'POST'" :type="(!empty($editLink) ? 'edit' : 'create')">

    <div style="max-width: 500px">
        <div>
            {{-- organization type --}}
            <div>
                <label for="organization_type" class="fw-bold mb-2">Organization Type</label>
                <select class="form-select form-select-md mb-3 text-capitalize" 
                    aria-label=".form-select-md" 
                    id="organization_type" 
                    name="organization_type" 
                    required>

                    <option selected disabled>Select your organization type</option>
                    @foreach ($organizationTypes as $organizationType)
                        <option value="{{ $organizationType->id }}" {{ (old('organization_type')==$organizationType->id || $organization->id==$organizationType->id ? 'selected' : '') }}>{{ $organizationType->type }}</option>
                    @endforeach
                </select>
            </div>

            {{-- organizations input --}}
            <x-form.input type="text" placeholder="Enter your organization's name" maxlength="200" required :name="'organization_name'" :display="'Organization Name'" value="{{ is_null($organization->organization) ? '' : $organization->organization->name }}" />

            {{-- position input --}}
            <x-form.input type="text" placeholder="Enter your position, in this organization" maxlength="120" :name="'position'" :display="'Position (optional)'" value="{{ $organization->position }}" />
        </div>

        <div style="max-width: 100px;">
            <x-form.submit-button>
                Next <i class="bi bi-arrow-right"></i>
            </x-form.submit-button>
        </div>
    </div>

</x-profile.publishyourwork.section>