@props(['step', 'action', 'method', 'type'])

<x-layout>
    {{-- @include ('._header') --}}

    <section style="padding: 30px 60px">
        {{-- header --}}
        <h4>
            Publish Your Work <small class="pe-3 fw-bold">(<span style="color: grey">{{ $step }}</span> / 5)</small>
        </h4>

        <x-profile.publishyourwork.menu />

        <div class="mt-20 p-1">
            <form action="{{ $action }}" method="{{ $method }}" {{ $attributes }}>
                @csrf

                @if(isset($type) && $type=='edit')
                    @method('PATCH')
                @endif

                {{-- display the validation errors --}}
                <x-form.errors />

                {{ $slot }}
            </form>
        </div>
    </section>
</x-layout>