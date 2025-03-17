<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <x-session-alerts />

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <x-posts.page-header :title="$post->title" />

                <x-posts.meta :date="$post->created_at->format('Y-m-d H:i:s')" :author="$post->user->name" />

                <!-- 加入瀏覽次數 -->
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    {{ $post->view_count ?? 0 }} 次瀏覽
                </div>

                <!-- 文章分類標籤 -->
                @if ($post->categories->count() > 0)
                    <div class="flex flex-wrap gap-2 my-4">
                        <span class="text-gray-600 font-medium">分類：</span>
                        @foreach ($post->categories as $category)
                            <a href="{{ route('posts.index', ['category' => $category->id]) }}"
                                class="px-3 py-1.5 bg-gray-100 text-sm text-gray-700 rounded-full border border-gray-200 hover:bg-gray-200 transition-colors">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                @endif

                @if (isset($post->excerpt))
                    <div class="text-gray-700 italic my-4 bg-gray-50 p-4 rounded-lg border-l-4 border-blue-500">
                        {{ $post->excerpt }}</div>
                @endif

                <x-posts.content :content="$post->content" />
            </div>

            <x-posts.actions :post="$post" />
        </div>

        <!-- 留言區塊 -->
        <div class="mt-8">
            <x-comments.list :comments="$comments" :postId="$post->id" />
        </div>
    </div>

    @stack('scripts')
</x-layouts.app>
