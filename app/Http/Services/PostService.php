<?php

namespace App\Http\Services;

use App\Http\Repositories\PostRepository;

class PostService
{
    private $postRepository;

    public function __construct(
        PostRepository $postRepository
    ) {
        $this->postRepository = $postRepository;
    }

    /**
     * 取得所有文章，支援搜尋和排序
     *
     * @param string|null $searchTerm 搜尋關鍵字
     * @param string $sortField 排序欄位
     * @param string $sortDirection 排序方向
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPosts($searchTerm = null, $sortField = 'created_at', $sortDirection = 'desc')
    {
        return $this->postRepository->getAllPosts($searchTerm, $sortField, $sortDirection);
    }

    public function getPostById($id)
    {
        return $this->postRepository->getPostById($id);
    }

    public function createPost($data)
    {
        $data['user_id'] = auth()->user()->id;

        return $this->postRepository->createPost($data);
    }

    public function updatePost($post, $data)
    {
        return $this->postRepository->updatePost($post, $data);
    }

    public function deletePost($post)
    {
        return $this->postRepository->deletePost($post);
    }
}
