@props([
    'type' => 'text',
    'name',
    'label',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'autofocus' => false
])

<div class="form-control">
    <label class="label" for="{{ $name }}">
        <span class="label-text">{{ $label }}</span>
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        class="input input-bordered @error($name) input-error @enderror"
        value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        {{ $autofocus ? 'autofocus' : '' }}
    />
    @error($name)
        <label class="label" for="{{ $name }}">
            <span class="label-text-alt text-error">{{ $message }}</span>
        </label>
    @enderror
</div>
