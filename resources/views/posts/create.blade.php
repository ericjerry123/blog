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

                    <!-- 文章狀態選擇 -->
                    <div class="form-control mb-6">
                        <label class="label">
                            <span class="label-text font-medium">發布狀態</span>
                        </label>
                        <div class="flex flex-wrap gap-4">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="status" value="published" class="radio radio-primary"
                                    {{ old('status', 'published') == 'published' ? 'checked' : '' }}
                                    onchange="toggleScheduleSection(this.value)">
                                <span>立即發布</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="status" value="draft" class="radio radio-primary"
                                    {{ old('status') == 'draft' ? 'checked' : '' }}
                                    onchange="toggleScheduleSection(this.value)">
                                <span>儲存為草稿</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="status" value="scheduled" class="radio radio-primary"
                                    {{ old('status') == 'scheduled' ? 'checked' : '' }}
                                    onchange="toggleScheduleSection(this.value)">
                                <span>排程發布</span>
                            </label>
                        </div>
                        @error('status')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- 排程發布時間 (根據選擇顯示或隱藏) -->
                    <div id="schedule-section" class="form-control mb-6 {{ old('status') == 'scheduled' ? '' : 'hidden' }}">
                        <label class="label">
                            <span class="label-text font-medium">排程發布時間</span>
                        </label>
                        <input type="datetime-local" name="scheduled_for" class="input input-bordered"
                            value="{{ old('scheduled_for') }}" min="{{ date('Y-m-d\TH:i') }}">
                        <p class="text-sm text-gray-500 mt-1">選擇您希望文章自動發布的日期和時間</p>
                        @error('scheduled_for')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- 分類選擇 -->
                    <div class="form-control mb-6">
                        <label class="label">
                            <span class="label-text font-medium">分類</span>
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mt-2">
                            @foreach ($categories as $category)
                                <label class="flex items-center space-x-2 cursor-pointer bg-gray-50 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        class="checkbox checkbox-primary"
                                        {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
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

                    <x-form.buttons submitText="新增文章" />
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleScheduleSection(status) {
            const scheduleSection = document.getElementById('schedule-section');
            if (status === 'scheduled') {
                scheduleSection.classList.remove('hidden');
            } else {
                scheduleSection.classList.add('hidden');
            }
        }
    </script>
</x-layouts.app>
