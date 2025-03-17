<?php

namespace App\Console\Commands;

use App\Http\Repositories\PostRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:publish-scheduled-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '發布所有已到達排程時間的文章';

    /**
     * @var PostRepository
     */
    protected $postRepository;

    /**
     * 建立新的命令實例
     */
    public function __construct(PostRepository $postRepository)
    {
        parent::__construct();
        $this->postRepository = $postRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('正在檢查排程文章...');

        $scheduledPosts = $this->postRepository->getScheduledPostsDueForPublishing();

        if ($scheduledPosts->isEmpty()) {
            $this->info('沒有需要發布的排程文章');
            return 0;
        }

        $count = 0;
        foreach ($scheduledPosts as $post) {
            $this->info("正在發布文章: {$post->title}");

            try {
                $this->postRepository->publishScheduledPost($post);
                $this->info("✓ 文章 ID: {$post->id} 已成功發布");
                $count++;
            } catch (\Exception $e) {
                $this->error("✗ 文章 ID: {$post->id} 發布失敗: {$e->getMessage()}");
                Log::error("發布排程文章失敗", [
                    'post_id' => $post->id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        $this->info("完成! 共發布了 {$count} 篇排程文章");

        return 0;
    }
}
