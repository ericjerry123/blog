<?php

namespace App\Http\Repositories;

use App\Models\Post;

class PostRepository
{
    /**
     * 取得所有文章
     */
    public function getAllPosts()
    {
        return Post::with('user')->paginate(10);
    }

    public function getPostById($id)
    {
        return Post::with('user')->find($id);
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
