@props(['i', 'name'])

@php
    $link   = "publish-your-work/" . str_replace(' ', '-', $name);
    $active = request()->is($link);
@endphp

<p class="fw-bold">
    <a 
        href="/{{ $link }}"
        class="me-4 text-capitalize {{ ($active ? 'text-dark link-offset-3' : 'text-secondary link-underline link-underline-opacity-0') }}">
        {{ $i . '. ' . $name }}
    </a>
</p>