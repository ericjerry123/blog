<?php

namespace App\View\Components\Comments;

use App\Models\Comment;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Item extends Component
{
    /**
     * 留言實例
     *
     * @var \App\Models\Comment
     */
    public $comment;

    /**
     * 文章 ID
     *
     * @var int
     */
    public $postId;

    /**
     * 創建組件實例。
     */
    public function __construct(Comment $comment, $postId)
    {
        $this->comment = $comment;
        $this->postId = $postId;
    }

    /**
     * 獲取組件要渲染的視圖。
     */
    public function render(): View|Closure|string
    {
        return view('components.comments.item');
    }
}
