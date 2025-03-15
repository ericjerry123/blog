<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <x-session-alerts />

        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-between items-center">
                    <h1 class="card-title text-2xl">新增文章</h1>
                    <a href="{{ route('posts.index') }}" class="hover:text-primary">返回</a>
                </div>

                <form action="{{ route('posts.store') }}" method="POST" class="mt-4">
                    @csrf

                    <x-form.input name="title" label="標題" :value="old('title')" />

                    <x-form.input name="excerpt" label="摘要" type="textarea" :value="old('excerpt')" />

                    <x-form.input name="content" label="內容" type="textarea" :value="old('content')" />

                    <div class="card-actions justify-end mt-6">
                        <a href="{{ route('posts.index') }}" class="btn btn-sm">取消</a>
                        <button type="submit" class="btn btn-sm btn-accent">新增文章</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
