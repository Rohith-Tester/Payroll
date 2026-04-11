@props([
    'label',
    'name',
    'type' => 'text',
    'autocomplete' => null,
    'required' => false,
])

<div class="auth-field">
    <label class="auth-label" for="{{ $name }}">{{ $label }}</label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name) }}"
        @if ($autocomplete !== null) autocomplete="{{ $autocomplete }}" @endif
        @if ($required) required @endif
        {{ $attributes->merge(['class' => 'auth-input']) }}
    />
    @error($name)
        <p class="auth-field-error" role="alert">{{ $message }}</p>
    @enderror
</div>
