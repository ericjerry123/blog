<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-between items-center">
                    <h1 class="card-title">{{ $post->title }}</h1>
                    <a href="{{ route('posts.index') }}" class="hover:text-primary">返回</a>
                </div>
                <div class="flex flex-row justify-start gap-4">
                    <span class="card-text">{{ $post->created_at->format('Y-m-d H:i:s') }}</span>
                    <span class="card-text">{{ $post->user->name }}</span>
                </div>
                <p class="card-text">{{ $post->content }}</p>
            </div>

            <div class="card-actions justify-end p-4">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">編輯</a>
                <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-sm btn-error">刪除</a>
            </div>
        </div>
    </div>
</x-layouts.app>
