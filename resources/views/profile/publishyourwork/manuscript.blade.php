
<x-profile.publishyourwork.section :step="4" :action="'/publish-your-work/manuscript'" :method="'POST'" enctype="multipart/form-data">

    <div class="container-fluid p-0">
        <div class="row">
            <div class="mb-3 col-12">
                <h5>Selected Journal: <small class="text-secondary">{{ $journal->name }}</small>.</h5>
            </div>
            <div class="col-12 col-md-6">
                {{-- article type --}}
                <div>
                    <label for="article_type" class="fw-bold mb-2">Article Type</label>
                    <select class="form-select form-select-md mb-3 text-capitalize" 
                        aria-label=".form-select-md" 
                        id="article_type" 
                        name="article_type" 
                        required>

                        <option selected disabled>Select your article type</option>
                        @foreach ($articleTypes as $articleType)
                            <option value="{{ $articleType->id }}" {{ (old('article_type')==$articleType->id ? 'selected' : '') }}>{{ $articleType->type }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- manuscript title --}}
                <x-form.textarea rows="3" placeholder="Enter your manuscript's title" required :name="'manuscript_title'" :display="'Manuscript Title'" maxlength="225">{{ old('manuscript_title') }}</x-form.textarea>

                {{-- manuscript abstract --}}
                <x-form.textarea rows="4" placeholder="Enter your manuscript's abstract" required :name="'manuscript_abstract'" :display="'Manuscript Abstract'">{{ old('manuscript_abstract') }}</x-form.textarea>
            </div>

            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Manuscript File <small class="text-secondary">(Select your manuscript file)</small></label>
                    <input class="form-control" type="file" id="formFile" name="manuscript_file" placeholder="Select your manuscript file" accept=".doc,.pdf,.docx" required>
                </div>

                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label fw-bold">Supporting Files <small class="text-secondary">(Select any supporting evidence (videos, document, etc.) that you'd like to use, to back-up your manuscript)</small></label>
                    <input class="form-control" type="file" id="formFileMultiple" name="supporting_files[]" accept=".pdf,.docx,.doc,.mp4,.avi|video/*,image/*" multiple>
                </div>
            </div>
        </div>

        <div style="max-width: 100px;">
            <x-form.submit-button>
                Next <i class="bi bi-arrow-right"></i>
            </x-form.submit-button>
        </div>
    </div>

</x-profile.publishyourwork.section>