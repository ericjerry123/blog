@props([
    'type' => 'submit',
    'color' => 'primary',
    'class' => ''
])

<div class="form-control mt-6">
    <button
        type="{{ $type }}"
        class="btn btn-{{ $color }} {{ $class }}"
    >
        {{ $slot }}
    </button>
</div>
