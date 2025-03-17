<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Services\PostService;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Events\PostViewed;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        // 獲取排序參數
        $sortField = $request->input('sort_field', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');

        // 驗證排序欄位，確保安全
        $allowedSortFields = ['created_at', 'title', 'updated_at'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }

        // 驗證排序方向
        $allowedSortDirections = ['asc', 'desc'];
        if (!in_array($sortDirection, $allowedSortDirections)) {
            $sortDirection = 'desc';
        }

        // 獲取分類過濾
        $categoryId = $request->input('category');
        $activeCategory = null;

        if ($categoryId) {
            $activeCategory = $this->postService->getCategoryById($categoryId);
            // 如果找不到該分類，重置為 null
            if (!$activeCategory) {
                $categoryId = null;
            }
        }

        // 獲取所有分類以供篩選
        $categories = $this->postService->getAllCategories();

        $posts = $this->postService->getAllPosts($searchTerm, $sortField, $sortDirection, $categoryId);

        return view('posts.index', compact(
            'posts',
            'searchTerm',
            'sortField',
            'sortDirection',
            'categories',
            'activeCategory'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->postService->getAllCategories();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->all();

        // 處理分類，如果有選擇的話
        if ($request->has('categories')) {
            $data['categories'] = $request->categories;
        }

        $this->postService->createPost($data);

        return redirect()->route('posts.index')->with('success', '文章已建立');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = $this->postService->getPostById($id);
        // 獲取文章的留言
        $comments = $post->comments()->with(['user', 'replies.user'])->orderBy('created_at', 'desc')->get();

        // 觸發文章瀏覽事件
        event(new PostViewed($post));

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = $this->postService->getPostById($id);
        $categories = $this->postService->getAllCategories();

        // 獲取文章當前的分類ID陣列，用於表單預選
        $selectedCategories = $post->categories->pluck('id')->toArray();

        return view('posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->all();

        // 處理分類，如果有選擇的話
        if ($request->has('categories')) {
            $data['categories'] = $request->categories;
        } else {
            // 如果沒有選擇任何分類，清空文章的所有分類
            $data['categories'] = [];
        }

        $this->postService->updatePost($post, $data);

        return redirect()->route('posts.index')->with('success', '文章已更新');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);

        return redirect()->route('posts.index')->with('success', '文章已刪除');
    }
}
