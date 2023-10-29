<x-layout>
    {{-- @include ('._header') --}}

    <section style="padding: 30px 60px">
        {{-- header --}}
        <h4>
            My Publications
        </h4>

        <div class="mt-20 p-1">
            {{ $slot }}
        </div>
    </section>
</x-layout>