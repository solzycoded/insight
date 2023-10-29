@props(['display'])

<div>
    <label for="title" class="fw-bold mb-2">{{ $display }}</label>
    <select class="form-select form-select-md mb-3 text-capitalize" 
        aria-label=".form-select-md" 
        name="title" 
        required 
        {{ $attributes }}>

        <option selected disabled>Select a title</option>
        @foreach ($titles as $title)
            <option value="{{ $title->id }}" {{ (old('title')==$title->id ? 'selected' : '') }}>{{ $title->name }}</option>
        @endforeach
    </select>
</div>