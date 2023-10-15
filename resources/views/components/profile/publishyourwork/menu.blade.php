@php
    $menuItems = ['personal details', 'organization', 'address', 'journal', 'manuscript & authors'];
@endphp

<div class="d-flex justify-content-left pb-1 border-bottom" style="margin-top: 20px !important;">

    @foreach ($menuItems as $i => $item)
        <x-profile.publishyourwork.menuitem :i="$i + 1" :name="$item" />
    @endforeach

</div>