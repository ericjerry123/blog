@props(['type', 'message'])

<div class="alert alert-{{ $type }} mb-4">
    {{ $message }}
    {{ $slot }}
</div>
