<x-profile.mypublications.section>
    <x-profile.mypublications.statusfilter :statusList="$statusList" />

    <div class="row mt-3">
        {{-- publications exist --}}
        @if(count($publications))
            @foreach ($publications as $i => $publication)
                <x-profile.mypublications.publication :publication="$publication" :status="$statusList" :i="$i" />
            @endforeach
        @else {{-- no publication --}}
            <div class="col-12">You don't have any <b>{{ (!request()->has('status') ? 'pending' : request('status')) }} publications</b> as of today.</div>
        @endif

        <div class="col-12">
            {{ $publications->links() }}
        </div>
    </div>
</x-profile.mypublications.section>