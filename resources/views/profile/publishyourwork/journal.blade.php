
<x-profile.publishyourwork.section :step="3" :action="'/publish-your-work/journal'" :method="'POST'">

    <div style="max-width: 500px">
        <div>
            {{-- journal --}}
            <div>
                <label for="journal" class="fw-bold mb-2">Journal Name</label>
                <select class="form-select form-select-md mb-3 text-capitalize" 
                    aria-label=".form-select-md" 
                    id="journal" 
                    name="journal_id" 
                    required>

                    <option selected disabled>Select your journal</option>
                    @foreach ($journals as $journal)
                        <option value="{{ $journal->id }}" {{ (old('journal_id')==$journal->id ? 'selected' : '') }}>{{ $journal->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="max-width: 100px;">
            <x-form.submit-button>
                Next <i class="bi bi-arrow-right"></i>
            </x-form.submit-button>
        </div>
    </div>

</x-profile.publishyourwork.section>