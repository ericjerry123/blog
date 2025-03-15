@props(['title'])

<div class="flex justify-between items-center">
    <h1 class="card-title text-2xl">{{ $title }}</h1>
    <a href="{{ route('posts.index') }}" class="hover:text-primary">返回</a>
</div>
