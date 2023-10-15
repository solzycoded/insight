@props(['step', 'action', 'method'])

<section style="padding: 30px 60px">
    {{-- header --}}
    <h4>
        Publish Your Work <small class="pe-3 fw-bold">(<span style="color: grey">{{ $step }}</span> / 5)</small>
    </h4>

    <x-profile.publishyourwork.menu />

    <div style="margin-top: 20px !important" class="p-1">
        <form action="{{ $action }}" method="{{ $method }}">
            @csrf

            {{-- display the validation errors --}}
            <x-form.errors />

            {{ $slot}}
        </form>
    </div>
</section>