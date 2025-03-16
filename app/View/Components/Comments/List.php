<?php

namespace App\View\Components\Comments;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CommentList extends Component
{
    /**
     * 留言集合
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $comments;

    /**
     * 文章 ID
     *
     * @var int
     */
    public $postId;

    /**
     * 創建組件實例。
     */
    public function __construct($comments, $postId)
    {
        $this->comments = $comments;
        $this->postId = $postId;
    }

    /**
     * 獲取組件要渲染的視圖。
     */
    public function render(): View|Closure|string
    {
        return view('components.comments.list');
    }
}
