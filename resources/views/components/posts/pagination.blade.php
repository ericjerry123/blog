@props(['paginator' => null])

@if (isset($paginator) && $paginator && $paginator->hasPages())
    <div class="pagination-wrapper py-4">
        <div class="flex justify-between items-center">
            <div class="pagination-info text-sm text-gray-600">
                顯示 {{ $paginator->firstItem() ?? 0 }} 至 {{ $paginator->lastItem() ?? 0 }} 筆，共 {{ $paginator->total() }} 筆結果
            </div>

            <div class="pagination-links">
                <div class="btn-group">
                    {{-- 上一頁按鈕 --}}
                    @if ($paginator->onFirstPage())
                        <button class="btn btn-sm btn-disabled" disabled>&laquo; 上一頁</button>
                    @else
                        <a href="{{ $paginator->appends(request()->query())->previousPageUrl() }}" class="btn btn-sm">&laquo; 上一頁</a>
                    @endif

                    {{-- 頁碼 --}}
                    @foreach ($paginator->appends(request()->query())->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="btn btn-sm btn-active" aria-current="page">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}" class="btn btn-sm">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- 下一頁按鈕 --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->appends(request()->query())->nextPageUrl() }}" class="btn btn-sm">下一頁 &raquo;</a>
                    @else
                        <button class="btn btn-sm btn-disabled" disabled>下一頁 &raquo;</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@elseif (isset($slot) && !empty($slot->toHtml()))
    {{ $slot }}
@endif
