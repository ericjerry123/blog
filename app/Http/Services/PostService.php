<?php

namespace App\Http\Services;

use App\Http\Repositories\PostRepository;
use App\Models\Post;

class PostService
{
    private $postRepository;

    public function __construct(
        PostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * 取得所有文章，支援搜尋、排序和分類過濾
     *
     * @param string|null $searchTerm 搜尋關鍵字
     * @param string $sortField 排序欄位
     * @param string $sortDirection 排序方向
     * @param int|null $categoryId 分類ID
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPosts($searchTerm = null, $sortField = 'created_at', $sortDirection = 'desc', $categoryId = null)
    {
        return $this->postRepository->getAllPosts($searchTerm, $sortField, $sortDirection, $categoryId);
    }

    public function getPostById($id)
    {
        return $this->postRepository->getPostById($id);
    }

    public function createPost($data)
    {
        $data['user_id'] = auth()->user()->id;

        // 創建文章
        $post = $this->postRepository->createPost($data);

        // 如果提供了分類，同步文章分類
        if (isset($data['categories'])) {
            $this->postRepository->syncPostCategories($post, $data['categories']);
        }

        return $post;
    }

    public function updatePost($post, $data)
    {
        // 更新文章
        $updated = $this->postRepository->updatePost($post, $data);

        // 如果提供了分類，同步文章分類
        if (isset($data['categories'])) {
            $this->postRepository->syncPostCategories($post, $data['categories']);
        }

        return $updated;
    }

    public function deletePost($post)
    {
        return $this->postRepository->deletePost($post);
    }

    /**
     * 取得所有分類
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        return $this->postRepository->getAllCategories();
    }

    /**
     * 取得指定分類
     *
     * @param int $id
     * @return \App\Models\Category|null
     */
    public function getCategoryById($id)
    {
        return $this->postRepository->getCategoryById($id);
    }

    /**
     * 獲取指定用戶的排程文章
     *
     * @param int $userId
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getScheduledPostsByUser($userId)
    {
        return $this->postRepository->getScheduledPostsByUser($userId);
    }

    /**
     * 發布排程文章
     *
     * @param Post $post
     * @return bool
     */
    public function publishScheduledPost($post)
    {
        return $this->postRepository->publishScheduledPost($post);
    }
}
