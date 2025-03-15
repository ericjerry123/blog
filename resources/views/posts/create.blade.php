<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <x-session-alerts />

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <x-posts.page-header title="新增文章" />

                <form action="{{ route('posts.store') }}" method="POST" class="mt-4">
                    @csrf

                    <x-form.input name="title" label="標題" :value="old('title')" />

                    <x-form.input name="excerpt" label="摘要" type="textarea" :value="old('excerpt')" />

                    <x-form.input name="content" label="內容" type="textarea" :value="old('content')" />

                    <x-form.buttons submitText="新增文章" />
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
