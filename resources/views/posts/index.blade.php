<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <x-session-alerts />

        <x-posts.header :title="'部落格文章'" />

        <!-- 搜尋、排序和分類表單 -->
        <div class="mb-8 bg-white p-6 rounded-lg shadow-sm">
            <form action="{{ route('posts.index') }}" method="GET" class="space-y-6">
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

                <!-- 分類過濾 -->
                <div>
                    <h3 class="text-gray-700 font-medium mb-3">文章分類</h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('posts.index', ['search' => $searchTerm ?? '', 'sort_field' => $sortField ?? 'created_at', 'sort_direction' => $sortDirection ?? 'desc']) }}"
                           class="px-4 py-2 rounded-full text-sm {{ !isset($activeCategory) ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            全部
                        </a>

                        @foreach($categories as $category)
                            <a href="{{ route('posts.index', ['category' => $category->id, 'search' => $searchTerm ?? '', 'sort_field' => $sortField ?? 'created_at', 'sort_direction' => $sortDirection ?? 'desc']) }}"
                               class="px-4 py-2 rounded-full text-sm {{ isset($activeCategory) && $activeCategory->id == $category->id ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- 排序選項 -->
                <div class="flex flex-wrap items-center gap-4 border-t pt-4">
                    <h3 class="text-gray-700 font-medium">排序方式：</h3>

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

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                        套用排序
                    </button>

                    @if((isset($sortField) && $sortField != 'created_at') || (isset($sortDirection) && $sortDirection != 'desc'))
                        <a href="{{ route('posts.index', ['search' => $searchTerm ?? '', 'category' => $activeCategory->id ?? null]) }}" class="px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            重設排序
                        </a>
                    @endif
                </div>

                <div class="text-sm text-gray-600 border-t pt-4">
                    <div class="flex flex-wrap gap-x-2">
                        @if(isset($searchTerm) && $searchTerm)
                            <span>搜尋: <strong>"{{ $searchTerm }}"</strong></span>
                        @endif

                        @if(isset($activeCategory))
                            <span>分類: <strong>"{{ $activeCategory->name }}"</strong></span>
                        @endif

                        <span>找到 <strong>{{ $posts->total() }}</strong> 篇文章</span>
                    </div>
                </div>
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
