@props(['post'])

<div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
    <div class="card-body">
        <div class="flex justify-between items-start">
            <h2 class="card-title text-xl">
                <a class="hover:text-blue-600" href="{{ route('posts.show', $post->id) }}">
                    {{ $post->title }}
                </a>
            </h2>

            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                </label>
                @can('update', $post)
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="{{ route('posts.edit', $post->id) }}">編輯</a></li>
                    @endcan
                    @can('delete', $post)
                        <li>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $post->id }}').submit();">
                                刪除
                            </a>
                            <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}"
                                method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
        <div class="flex items-center gap-3 text-sm text-gray-600 mb-2">
            <div>由 {{ $post->user->name }} · {{ $post->created_at->format('Y-m-d H:i') }}</div>
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
        </div>

        <!-- 文章分類標籤 -->
        @if ($post->categories->count() > 0)
            <div class="flex flex-wrap gap-1 mb-3">
                @foreach ($post->categories as $category)
                    <a href="{{ route('posts.index', ['category' => $category->id]) }}"
                        class="px-2 py-1 bg-gray-200 text-xs text-gray-700 rounded-full hover:bg-gray-300">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <p class="mt-2">{{ $post->excerpt }}</p>
        <div class="card-actions justify-end mt-4">
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-primary">閱讀更多</a>
        </div>
    </div>
</div>
