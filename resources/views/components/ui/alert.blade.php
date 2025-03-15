@props(['type' => 'info', 'message' => ''])

<div {{ $attributes->merge(['class' => "alert alert-{$type} mb-4"]) }}>
    {{ $message }}
    {{ $slot }}
</div>
