@php
    $menuItems = ['personal details', 'organization', 'journal', 'manuscript', 'authors'];
@endphp

<div class="d-flex justify-content-left mb-1 border-bottom p-0" style="overflow-x: auto; margin-top: 20px !important">

    @foreach ($menuItems as $i => $item)
        <x-profile.publishyourwork.menuitem :i="$i + 1" :name="$item" />
    @endforeach

</div>