<?php

namespace App\Http\Repositories;

use App\Models\Post;
use App\Models\Category;

class PostRepository
{
    /**
     * 取得所有文章，支援搜尋、排序和分類過濾功能
     *
     * @param string|null $searchTerm 搜尋關鍵字
     * @param string $sortField 排序欄位
     * @param string $sortDirection 排序方向
     * @param int|null $categoryId 分類ID
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllPosts($searchTerm = null, $sortField = 'created_at', $sortDirection = 'desc', $categoryId = null)
    {
        $query = Post::with(['user', 'categories']);

        // 只顯示已發布的文章
        $query->where(function($q) {
            $q->where('status', 'published')
              ->orWhere(function($sq) {
                  $sq->where('status', 'scheduled')
                     ->where('scheduled_for', '<=', now());
              });
        });

        // 按分類過濾
        if ($categoryId) {
            $query->whereHas('categories', function ($q) use ($categoryId) {
                $q->where('categories.id', $categoryId);
            });
        }

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
        return Post::with(['user', 'comments.user', 'comments.replies.user', 'categories'])->find($id);
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

    /**
     * 取得所有分類
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        return Category::all();
    }

    /**
     * 取得指定分類
     *
     * @param int $id
     * @return \App\Models\Category|null
     */
    public function getCategoryById($id)
    {
        return Category::find($id);
    }

    /**
     * 更新文章的分類
     *
     * @param \App\Models\Post $post
     * @param array $categoryIds
     * @return void
     */
    public function syncPostCategories($post, $categoryIds)
    {
        $post->categories()->sync($categoryIds);
    }

    /**
     * 取得所有需要發布的排程文章
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getScheduledPostsDueForPublishing()
    {
        return Post::dueForPublishing()->get();
    }

    /**
     * 將排程文章發布
     *
     * @param Post $post
     * @return bool
     */
    public function publishScheduledPost(Post $post)
    {
        return $post->markAsPublished();
    }
}
