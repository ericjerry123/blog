<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <x-session-alerts />

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <x-posts.page-header title="編輯文章" />

                <form action="{{ route('posts.update', $post->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')

                    <x-form.input name="title" label="標題" :value="$post->title" />

                    @if(isset($post->excerpt))
                        <x-form.input name="excerpt" label="摘要" type="textarea" :value="$post->excerpt" />
                    @endif

                    <x-form.input name="content" label="內容" type="textarea" :value="$post->content" />

                    <x-form.buttons submitText="更新文章" />
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
