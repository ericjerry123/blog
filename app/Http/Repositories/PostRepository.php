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
}
