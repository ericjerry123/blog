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
        return Post::all();
    }

    public function getPostById($id)
    {
        return Post::find($id);
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
