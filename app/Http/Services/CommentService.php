<?php

namespace App\Http\Services;

use App\Http\Repositories\CommentRepository;
use App\Models\Comment;

class CommentService
{
    private $commentRepository;

    public function __construct(
        CommentRepository $commentRepository
    ) {
        $this->commentRepository = $commentRepository;
    }

    /**
     * 獲取特定文章的留言
     *
     * @param int $postId 文章ID
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPostComments($postId)
    {
        return $this->commentRepository->getPostComments($postId);
    }

    /**
     * 創建新留言
     *
     * @param array $data 留言數據
     * @return Comment
     */
    public function createComment($data)
    {
        $data['user_id'] = auth()->user()->id;

        return $this->commentRepository->createComment($data);
    }

    /**
     * 更新留言
     *
     * @param Comment $comment 留言實例
     * @param array $data 更新數據
     * @return bool
     */
    public function updateComment(Comment $comment, $data)
    {
        return $this->commentRepository->updateComment($comment, $data);
    }

    /**
     * 刪除留言
     *
     * @param Comment $comment 留言實例
     * @return bool|null
     */
    public function deleteComment(Comment $comment)
    {
        return $this->commentRepository->deleteComment($comment);
    }
}
