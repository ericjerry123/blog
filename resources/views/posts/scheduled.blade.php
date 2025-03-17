<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <x-session-alerts />

        <div class="flex justify-between items-center mb-6">
            <x-posts.header :title="'我的排程文章'" />

            <div class="flex gap-4">
                <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    返回文章列表
                </a>
                <a href="{{ route('posts.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    新增文章
                </a>
            </div>
        </div>

        <div class="mb-8 bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-xl font-bold mb-4">排程文章說明</h2>
            <p class="mb-2">在這裡，您可以查看所有設定為排程發布的文章。</p>
            <ul class="list-disc list-inside mb-4 text-gray-700">
                <li>排程文章將在設定的發布時間自動變更為已發布狀態</li>
                <li>在發布時間到達前，您可以隨時編輯或刪除這些文章</li>
                <li>您也可以取消排程並立即發布或改為草稿狀態</li>
            </ul>
        </div>

        @if($posts->isEmpty())
            <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">沒有排程文章</h3>
                <p class="text-gray-600 mb-4">您目前沒有設定任何排程發布的文章。</p>
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    新增文章
                </a>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                文章標題
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                排程時間
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                分類
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                狀態
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                操作
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $post)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                                    <div class="text-sm text-gray-500">建立於 {{ $post->created_at->format('Y-m-d H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $post->scheduled_for->format('Y-m-d H:i') }}</div>
                                    <div class="text-sm text-gray-500">
                                        @if($post->scheduled_for->isPast())
                                            <span class="text-red-500">已過期，等待系統處理</span>
                                        @else
                                            剩餘 {{ $post->scheduled_for->diffForHumans(['parts' => 2]) }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($post->categories as $category)
                                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                        @if($post->categories->isEmpty())
                                            <span class="text-gray-500 text-sm">無分類</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        排程發布
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:text-blue-900">
                                            預覽
                                        </a>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                            編輯
                                        </a>
                                        <form action="{{ route('posts.publish-now', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('確定要立即發布此文章嗎？');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:text-green-900">
                                                立即發布
                                            </button>
                                        </form>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('確定要刪除此排程文章嗎？');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                刪除
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
