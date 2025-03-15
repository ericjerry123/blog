<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * 在所有授權檢查之前執行的方法
     */
    public function before(User $user, string $ability): bool|null
    {
        return null;
    }

    /**
     * 判斷用戶是否可以查看任何文章
     */
    public function viewAny(?User $user): bool
    {
        return true; // 所有用戶都可以查看文章列表
    }

    /**
     * 判斷用戶是否可以查看指定文章
     */
    public function view(?User $user, Post $post): bool
    {
        return true;
    }

    /**
     * 判斷用戶是否可以創建文章
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * 判斷用戶是否可以更新文章
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷用戶是否可以刪除文章
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷用戶是否可以恢復已刪除的文章
     */
    public function restore(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * 判斷用戶是否可以永久刪除文章
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}
