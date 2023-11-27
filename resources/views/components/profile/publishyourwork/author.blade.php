@props(['author'])

<div class="col-12 col-sm-4 new-author mb-2">
    <div class="d-flex justify-content-start border border-1 rounded-1 p-1 position-relative">
        <span class="ps-1 new-author-name fw-bold pe-4" style="word-break: break-word">{{ $author->name }}</span>
        <div class="position-absolute top-0 end-0 bottom-0 p-0" style="height: 100%;">
            <button type="button" class="btn btn-transparent text-danger rounded-0 m-0 p-0 remove-author" style="height: 100%;" onClick="removeAuthor(this)">
                <i class="bi bi-x"></i>
            </button>
        </div>
    </div>
</div>