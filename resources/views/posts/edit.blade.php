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

                    <!-- 分類選擇 -->
                    <div class="form-control mb-6">
                        <label class="label">
                            <span class="label-text font-medium">分類</span>
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-2">
                            @foreach($categories as $category)
                                <label class="flex items-center space-x-2 cursor-pointer bg-gray-50 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                           class="checkbox checkbox-primary"
                                           {{ in_array($category->id, old('categories', $selectedCategories)) ? 'checked' : '' }}>
                                    <span>{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('categories')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <x-form.buttons submitText="更新文章" />
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
