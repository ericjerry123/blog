<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <x-session-alerts />

        <x-posts.header :title="'部落格文章'" />

        <!-- 搜尋和排序表單 -->
        <div class="mb-8">
            <form action="{{ route('posts.index') }}" method="GET" class="space-y-4">
                <!-- 搜尋欄位 -->
                <div class="flex items-center">
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
                </div>

                <!-- 排序選項 -->
                <div class="flex flex-wrap items-center gap-4">
                    <span class="text-gray-700">排序方式：</span>

                    <!-- 排序欄位選擇 -->
                    <div class="flex items-center">
                        <select name="sort_field" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="created_at" {{ ($sortField ?? 'created_at') == 'created_at' ? 'selected' : '' }}>發佈日期</option>
                            <option value="title" {{ ($sortField ?? '') == 'title' ? 'selected' : '' }}>標題</option>
                            <option value="updated_at" {{ ($sortField ?? '') == 'updated_at' ? 'selected' : '' }}>更新日期</option>
                        </select>
                    </div>

                    <!-- 排序方向選擇 -->
                    <div class="flex items-center">
                        <select name="sort_direction" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="desc" {{ ($sortDirection ?? 'desc') == 'desc' ? 'selected' : '' }}>由新到舊</option>
                            <option value="asc" {{ ($sortDirection ?? '') == 'asc' ? 'selected' : '' }}>由舊到新</option>
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        套用排序
                    </button>

                    @if((isset($sortField) && $sortField != 'created_at') || (isset($sortDirection) && $sortDirection != 'desc'))
                        <a href="{{ route('posts.index', ['search' => $searchTerm ?? '']) }}" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                            重設排序
                        </a>
                    @endif
                </div>

                @if(isset($searchTerm) && $searchTerm)
                    <div class="text-sm text-gray-600">
                        搜尋: "{{ $searchTerm }}" - 找到 {{ $posts->total() }} 篇文章
                    </div>
                @endif
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <x-posts.card :post="$post" />
            @endforeach
        </div>

        <x-posts.pagination :paginator="$posts" />
    </div>
</x-layouts.app>
