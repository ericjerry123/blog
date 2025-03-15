@props([
    'title',
    'description' => ''
])

<div class="text-center lg:text-left">
    <h1 class="text-5xl font-bold">{{ $title }}</h1>
    @if($description)
        <p class="py-6">{{ $description }}</p>
    @endif
</div>
