@props(['currentPage' => 1])

<div class="mt-10 flex justify-center">
    <div class="join">
        <button class="join-item btn btn-ghost">«</button>
        <button class="join-item btn btn-ghost">第 {{ $currentPage }} 頁</button>
        <button class="join-item btn btn-ghost">»</button>
    </div>
</div>
