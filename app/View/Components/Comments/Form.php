<?php

namespace App\View\Components\Comments;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    /**
     * 文章 ID
     *
     * @var int
     */
    public $postId;

    /**
     * 父留言 ID
     *
     * @var int|null
     */
    public $parentId;

    /**
     * 創建組件實例。
     */
    public function __construct($postId, $parentId = null)
    {
        $this->postId = $postId;
        $this->parentId = $parentId;
    }

    /**
     * 獲取組件要渲染的視圖。
     */
    public function render(): View|Closure|string
    {
        return view('components.comments.form');
    }
}
