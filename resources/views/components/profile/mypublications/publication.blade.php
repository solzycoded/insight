@props(['publication', 'status', 'i'])

<div class="col-12 col-sm-6 col-md-4 publication-{{ $i }}">
    <div class="card shadow p-0 mb-5 bg-body rounded border-0">
        <x-profile.mypublications.publication-header :publication="$publication" :status="$status" />
        <div class="card-body p-3">
            {{-- journal --}}
            <h5 class="card-title"><small class="text-secondary">Published in</small> {{ $publication->journal->name }}</h5>
            <p class="card-text">{{ $publication->abstract }}</p>
            <p class="card-text">Published on <b>{{ date('D M, Y', strtotime($publication->created_at)) }}</b></p>
            <div class="d-flex justify-content-start border-top pt-2">
                {{-- <a href="/publish-your-work/" class="btn btn-transparent text-secondary"><i class="bi bi-pencil"></i></a> --}}
                <form action="/my-publications/{{ $publication->id }}" method="POST" class="delete-publication-form" publication-index="{{ $i }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-transparent text-danger"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>