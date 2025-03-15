<?php

namespace App\Http\Repositories;

use App\Models\Post;

class PostRepository
{
    /**
     * 取得所有文章，支援搜尋和排序功能
     *
     * @param string|null $searchTerm 搜尋關鍵字
     * @param string $sortField 排序欄位
     * @param string $sortDirection 排序方向
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPosts($searchTerm = null, $sortField = 'created_at', $sortDirection = 'desc')
    {
        $query = Post::with('user');

        if ($searchTerm) {
            $this->searchPosts($query, $searchTerm);
        }

        // 應用排序
        $query->orderBy($sortField, $sortDirection);

        return $query->paginate(10);
    }

    /**
     * 在查詢中增加搜尋條件
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $searchTerm
     * @return void
     */
    public function searchPosts($query, $searchTerm)
    {
        if (!$searchTerm) {
            return;
        }

        $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'like', "%{$searchTerm}%")
              ->orWhere('content', 'like', "%{$searchTerm}%");
        });
    }

    public function getPostById($id)
    {
        return Post::with(['user', 'comments.user', 'comments.replies.user'])->find($id);
    }

    public function createPost($data)
    {
        return Post::create($data);
    }

    public function updatePost($post, $data)
    {
        return $post->update($data);
    }

    public function deletePost($post)
    {
        return $post->delete();
    }
}
