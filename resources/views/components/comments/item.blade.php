<div class="card bg-base-100 shadow-sm">
    <div class="card-body">
        <div class="flex justify-between items-start">
            <div class="flex items-center space-x-3">
                <div class="avatar placeholder">
                    <div class="bg-neutral-focus text-neutral-content rounded-full w-12">
                        <span>{{ substr($comment->user->name, 0, 2) }}</span>
                    </div>
                </div>
                <div>
                    <div class="font-bold">{{ $comment->user->name }}</div>
                    <div class="text-sm opacity-50">{{ $comment->created_at->diffForHumans() }}</div>
                </div>
            </div>

            @if(auth()->check() && auth()->id() === $comment->user_id)
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li>
                            <a href="{{ route('comments.edit', $comment) }}">編輯</a>
                        </li>
                        <li>
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('確定要刪除此留言嗎？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-left w-full">刪除</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
        </div>

        <p class="mt-4">{{ $comment->content }}</p>

        <div class="card-actions justify-end mt-4">
            @auth
                <button type="button" class="btn btn-ghost btn-xs reply-toggle" data-comment-id="{{ $comment->id }}">
                    回覆
                </button>
            @endauth
        </div>

        <div id="reply-form-{{ $comment->id }}" class="hidden mt-4">
            <x-comments.form :postId="$postId" :parentId="$comment->id" />
        </div>

        @if($comment->replies->count() > 0)
            <div class="mt-4 space-y-4 pl-8 border-l-2 border-base-300">
                @foreach($comment->replies as $reply)
                    <div class="card bg-base-200 shadow-sm">
                        <div class="card-body p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center space-x-3">
                                    <div class="avatar placeholder">
                                        <div class="bg-neutral-focus text-neutral-content rounded-full w-8">
                                            <span>{{ substr($reply->user->name, 0, 2) }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ $reply->user->name }}</div>
                                        <div class="text-xs opacity-50">{{ $reply->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>

                                @if(auth()->check() && auth()->id() === $reply->user_id)
                                    <div class="dropdown dropdown-end">
                                        <label tabindex="0" class="btn btn-ghost btn-xs">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                            </svg>
                                        </label>
                                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                            <li>
                                                <a href="{{ route('comments.edit', $reply) }}">編輯</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('comments.destroy', $reply) }}" method="POST" onsubmit="return confirm('確定要刪除此回覆嗎？');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-left w-full">刪除</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <p class="mt-2">{{ $reply->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 重新獲取所有回覆按鈕，確保每次頁面加載都能正確綁定
        const replyButtons = document.querySelectorAll('.reply-toggle');

        replyButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                // 防止事件冒泡
                event.preventDefault();

                const commentId = this.getAttribute('data-comment-id');
                const replyForm = document.getElementById(`reply-form-${commentId}`);

                if (replyForm.classList.contains('hidden')) {
                    // 隱藏所有回覆表單
                    document.querySelectorAll('[id^="reply-form-"]').forEach(form => {
                        form.classList.add('hidden');
                    });

                    // 重置所有回覆按鈕文字
                    document.querySelectorAll('.reply-toggle').forEach(btn => {
                        btn.textContent = '回覆';
                    });

                    // 顯示當前回覆表單
                    replyForm.classList.remove('hidden');
                    this.textContent = '取消回覆';
                } else {
                    replyForm.classList.add('hidden');
                    this.textContent = '回覆';
                }
            });
        });
    });
</script>
@endpush
