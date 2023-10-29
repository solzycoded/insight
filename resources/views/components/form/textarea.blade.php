@props(['name', 'display'])

<x-form.field>

    <x-form.label :name="$name" :display="$display" />

    <textarea class="form-control p-2 rounded"
        name="{{ $name }}"
        id="{{ $name }}"
        required
        {{ $attributes }}
    >{{ $slot }}</textarea>

    <x-form.error :name="$name" />

</x-form.field>