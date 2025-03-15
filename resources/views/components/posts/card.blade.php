@props(['post'])

<div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300">
    <div class="card-body">
        <div class="flex justify-between items-start">
            <h2 class="card-title text-xl">{{ $post['title'] }}</h2>
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                </label>
                @can('update', $post)
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="{{ route('posts.edit', $post['id']) }}">編輯</a></li>
                    @endcan
                    @can('delete', $post)
                        <li>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $post['id'] }}').submit();">
                                刪除
                            </a>
                            <form id="delete-form-{{ $post['id'] }}" action="{{ route('posts.destroy', $post['id']) }}"
                                method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>
        <p class="text-sm text-gray-600 mb-2">由 {{ $post['user']['name'] }} · {{ $post['created_at'] }}</p>
        <p>{{ $post['excerpt'] }}</p>
        <div class="card-actions justify-end mt-4">
            <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-sm btn-primary">閱讀更多</a>
        </div>
    </div>
</div>
