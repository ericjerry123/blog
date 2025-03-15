<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <div class="flex justify-between items-center">
                    <h1 class="card-title text-2xl">編輯文章</h1>
                    <a href="{{ route('posts.index') }}" class="hover:text-primary">返回</a>
                </div>

                <form action="{{ route('posts.update', $post->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">標題</label>
                        <input type="text" id="title" name="title" value="{{ $post->title }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">內容</label>
                        <textarea id="content" name="content" rows="6"
                                 class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary focus:border-primary">{{ $post->content }}</textarea>
                    </div>

                    <div class="card-actions justify-end mt-6">
                        <a href="{{ route('posts.index') }}" class="btn btn-sm">取消</a>
                        <button type="submit" class="btn btn-sm btn-accent">更新文章</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
