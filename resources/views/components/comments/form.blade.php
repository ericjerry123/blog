<div class="mt-4 {{ $parentId ? 'ml-8' : '' }}">
    <form action="{{ route('comments.store') }}" method="POST" class="space-y-4 comment-form">
        @csrf
        <input type="hidden" name="post_id" value="{{ $postId }}">
        @if($parentId)
            <input type="hidden" name="parent_id" value="{{ $parentId }}">
        @endif

        <div>
            <textarea
                name="content"
                rows="3"
                class="textarea textarea-bordered w-full"
                placeholder="{{ $parentId ? '發表您的回覆...' : '發表您的留言...' }}"
            >{{ old('content') }}</textarea>
            @error('content')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">
                {{ $parentId ? '回覆' : '發表留言' }}
            </button>
        </div>
    </form>
</div>