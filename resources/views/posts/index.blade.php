<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <x-session-alerts />

        <x-posts.header :title="'部落格文章'" />

        <!-- 搜尋表單 -->
        <div class="mb-8">
            <form action="{{ route('posts.index') }}" method="GET" class="flex items-center">
                <div class="relative flex-grow">
                    <input
                        type="text"
                        name="search"
                        placeholder="搜尋文章標題或內容..."
                        value="{{ $searchTerm ?? '' }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
                @if(isset($searchTerm) && $searchTerm)
                    <a href="{{ route('posts.index') }}" class="ml-2 px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        清除
                    </a>
                @endif
            </form>
            @if(isset($searchTerm) && $searchTerm)
                <div class="mt-2 text-sm text-gray-600">
                    搜尋: "{{ $searchTerm }}" - 找到 {{ $posts->total() }} 篇文章
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <x-posts.card :post="$post" />
            @endforeach
        </div>

        <x-posts.pagination :paginator="$posts" />
    </div>
</x-layouts.app>
