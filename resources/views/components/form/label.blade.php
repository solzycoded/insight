@props(['name', 'display'])

<label 
    class="form-label text-capitalize fw-bold" 
    for="{{ $name }}">
    {{ ucwords($display) }}
</label>