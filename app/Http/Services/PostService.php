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

    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }

    public function getPostById($id)
    {
        return $this->postRepository->getPostById($id);
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
