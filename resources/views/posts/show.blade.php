<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <x-session-alerts />

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <x-posts.page-header :title="$post->title" />

                <x-posts.meta
                    :date="$post->created_at->format('Y-m-d H:i:s')"
                    :author="$post->user->name"
                />

                @if(isset($post->excerpt))
                    <div class="text-gray-700 italic my-2">{{ $post->excerpt }}</div>
                @endif

                <x-posts.content :content="$post->content" />
            </div>

            <x-posts.actions :post="$post" />
        </div>
    </div>
</x-layouts.app>
