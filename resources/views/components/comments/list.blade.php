<div class="mt-8">
    <h2 class="text-2xl font-bold mb-4">留言 ({{ $comments->sum(function($comment) { return 1 + $comment->replies->count(); }) }})</h2>

    @auth
        <x-comments.form :postId="$postId" />
    @else
        <div class="alert alert-info">
            <div>
                <span>請<a href="{{ route('login.create') }}" class="link link-primary">登入</a>後發表留言</span>
            </div>
        </div>
    @endauth

    <div class="mt-8 space-y-6">
        @forelse($comments as $comment)
            <x-comments.item :comment="$comment" :postId="$postId" />
        @empty
            <div class="text-center py-4">
                <p class="text-gray-500">暫無留言，成為第一個留言的人吧！</p>
            </div>
        @endforelse
    </div>
</div>
