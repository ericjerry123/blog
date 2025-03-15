@props(['title' => '部落格文章'])

<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-primary">{{ $title }}</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        新增文章
    </a>
</div>
