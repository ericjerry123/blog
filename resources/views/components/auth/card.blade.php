@props([
    'action' => '',
    'method' => 'POST'
])

<div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
    <form method="{{ $method }}" action="{{ $action }}" class="card-body">
        {{ $slot }}
    </form>
</div>
