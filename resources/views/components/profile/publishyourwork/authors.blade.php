<x-layout>
    <section style="padding: 30px 60px">
        {{-- header --}}
        <h4>
            Publish Your Work <small class="pe-3 fw-bold">(<span style="color: grey">5</span> / 5)</small>
        </h4>

        <x-profile.publishyourwork.menu />

        <div class="mt-20 p-1">
            <div style="max-width: 500px">
                {{-- errors --}}
                <div>
                    <div class="container-fluid p-0">
                        <label for="name" class="fw-bold">
                            Author Full Name <small class="text-secondary">(click ENTER after each entry)</small>
                        </label>

                        <div class="input-group mt-2" id="name">
                            <input type="text" name="last_name" class="form-control" placeholder="e.g. Dr Idris Birmingham" maxlength="60" required id="author-name" maxlength="120">

                            <div>
                                <button type="button" role="button" class="btn btn-dark text-white fw-bold rounded-0 rounded-end-2" id="add-author">
                                    <span>Add</span>
                                    <i class="bi bi-plus-circle ps-1"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row mt-3 border-top pt-2" id="author-list">
                            <div class="ps-3 fw-bold col-12 col-sm-4 mb-2" id="author-name-live" style="word-break: break-word;"></div>
                            @foreach ($authors as $author)
                                <x-profile.publishyourwork.author :author="$author" />
                            @endforeach
                        </div>
                    </div>
                </div>

                <form action="/publish-your-work/authors" method="POST" class="authors-form">
                    @csrf

                    <div style="max-width: 100px;" class="mt-4">
                        @if (count($authors))
                            <span class="d-none" id="update-authors"></span>
                        @endif

                        <x-form.submit-button>
                            Finish <i class="bi bi-check2-circle"></i>
                        </x-form.submit-button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layout>
