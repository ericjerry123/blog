@props(['post'])

<div class="card-actions justify-end p-4">
    @can('update', $post)
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">編輯</a>
    @endcan

    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('確定要刪除此文章嗎？')">刪除</button>
        </form>
    @endcan

    {{ $slot }}
</div>
