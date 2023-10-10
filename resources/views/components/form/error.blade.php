@props(['name'])

@error($name)
    <small class="p-0 text-danger">{{ $message }}</small>
@enderror