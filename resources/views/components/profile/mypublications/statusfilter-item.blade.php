@props(['publicationStatus', 'statusList'])

@php
    $statusName     = $publicationStatus->name;
    $selectedStatus = request('status')==$statusName ? true : false;
@endphp

<div class="col-4 col-sm-3 col-md-2 mb-2" style="width: inherit; {{ ($selectedStatus ? '' : '') }}" >
    <a 
        href="{{ (!$selectedStatus ? ('/my-publications/?status=' . $statusName) : 'role="button"') }}"
        class="btn btn-{{ $statusList[$statusName] }} text-white fw-bold text-capitalize"
        style="{{ ($selectedStatus ? 'opacity: 0.5; cursor: not-allowed' : '') }}">
        {{ $statusName }}
    </a>
</div>