<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * 警告類型
     *
     * @var string
     */
    public string $type;

    /**
     * 警告消息
     *
     * @var string
     */
    public string $message;

    /**
     * 創建組件實例
     */
    public function __construct(string $type, string $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * 獲取組件表示的視圖
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }

    /**
     * 檢查警告是否有效（有消息內容）
     */
    public function shouldRender(): bool
    {
        return !empty($this->message);
    }
}
