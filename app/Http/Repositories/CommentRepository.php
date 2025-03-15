<?php

namespace App\Http\Repositories;

use App\Models\Comment;
use App\Models\Post;

class CommentRepository
{
    /**
     * 獲取特定文章的所有一級留言
     *
     * @param int $postId 文章ID
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPostComments($postId)
    {
        return Comment::with(['user', 'replies.user'])
            ->where('post_id', $postId)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * 創建新留言
     *
     * @param array $data 留言數據
     * @return Comment
     */
    public function createComment($data)
    {
        return Comment::create($data);
    }

    /**
     * 更新留言內容
     *
     * @param Comment $comment 留言實例
     * @param array $data 更新數據
     * @return bool
     */
    public function updateComment(Comment $comment, $data)
    {
        return $comment->update($data);
    }

    /**
     * 刪除留言
     *
     * @param Comment $comment 留言實例
     * @return bool|null
     */
    public function deleteComment(Comment $comment)
    {
        return $comment->delete();
    }
}
