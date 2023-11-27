@props(['statusList'])

<div class="row mt-2 border-bottom pb-2">
    @foreach ($status as $publicationStatus)
        <x-profile.mypublications.statusfilter-item :publicationStatus="$publicationStatus" :statusList="$statusList" />
    @endforeach
</div>