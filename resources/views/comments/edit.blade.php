<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">編輯留言</h2>

                <form action="{{ route('comments.update', $comment) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <textarea
                            name="content"
                            rows="5"
                            class="textarea textarea-bordered w-full"
                            placeholder="編輯您的留言..."
                        >{{ old('content', $comment->content) }}</textarea>
                        @error('content')
                            <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('posts.show', $comment->post_id) }}" class="btn btn-ghost">取消</a>
                        <button type="submit" class="btn btn-primary">更新留言</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
