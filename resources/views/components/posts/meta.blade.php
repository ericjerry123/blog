@props(['date', 'author'])

<div class="flex flex-row justify-start gap-4 text-sm text-gray-600 my-2">
    <span>{{ $date }}</span>
    <span>{{ $author }}</span>
    {{ $slot }}
</div>
