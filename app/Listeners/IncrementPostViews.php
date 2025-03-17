<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\PostViewed;
use Illuminate\Support\Facades\Cache;

class IncrementPostViews
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostViewed $event): void
    {
        // 生成簡單的快取鍵
        $cacheKey = "post.{$event->post->id}.views";

        // 使用快取防止短時間內重複計數
        Cache::remember($cacheKey, now()->addMinutes(5), function () use ($event) {
            // 直接增加文章瀏覽次數
            $event->post->increment('view_count');
            return true;
        });
    }
}
