@props(['manuscriptFile'])

<div {{ $attributes(['class' => "input-group"]) }} style="width: 100%">
    <input type="hidden" value="{{ $manuscriptFile->id }}" name="manuscript_file">
    <p class="fw-bold text-secondary" style="width: 90%">{{ basename($manuscriptFile->manuscript_file) }}</p>
    <div class="d-flex justify-content-end fw-bold">
        <a href="{{ asset('storage/' . $manuscriptFile->manuscript_file) }}" class="btn btn-tranparent p-0 ps-2" target="_blank"><i class="bi bi-eye"></i></a>
        <a role="button" class="btn btn-tranparent p-0 ps-4 text-danger" onClick="$(this).parent().parent().remove()"><i class="bi bi-x"></i></a>
    </div>
</div>