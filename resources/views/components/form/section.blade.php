@props(['action', 'method' => 'GET', 'header'])

<div class="d-flex align-items-center justify-content-center">
    <div style="margin-top: 60px; max-width: 450px !important">
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