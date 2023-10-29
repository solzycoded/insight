@props(['action', 'method' => 'GET', 'header'])

<div class="d-flex align-items-center justify-content-center" style="width: 100% !important">
    <div style="margin-top: 60px; width: inherit !important; max-width: 350px !important">
        <form action="{{ $action }}" method="{{ $method }}">
            @csrf

            {{-- header --}}
            <div class="text-center" style="margin-bottom: 20px">
                <h3>{{ $header['title'] }}</h3>
                <small style="color: lightgray">{{ $header['description'] }}</small>
            </div>

            {{-- display the validation errors --}}
            <x-form.errors /> 

            {{-- input fields (e.g. input, textarea, etc.) --}}
            <div>
                {{ $slot }}
            </div>
        </form>
    </div>
</div>