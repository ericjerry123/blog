<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Services\CommentService;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
        $this->middleware('auth');
        $this->authorizeResource(Comment::class, 'comment', [
            'except' => ['store']
        ]);
    }

    /**
     * 存儲新創建的留言
     */
    public function store(StoreCommentRequest $request)
    {
        $validatedData = $request->validated();

        $this->authorize('create', Comment::class);
        $this->commentService->createComment($validatedData);

        return redirect()->back()->with('success', '留言已發布');
    }

    /**
     * 顯示編輯留言的表單
     */
    public function edit(Comment $comment)
    {
        // Policy 已通過 authorizeResource 自動檢查授權
        return view('comments.edit', compact('comment'));
    }

    /**
     * 更新留言
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|min:2|max:1000',
        ]);

        // Policy 已通過 authorizeResource 自動檢查授權
        $this->commentService->updateComment($comment, $request->only('content'));

        return redirect()->route('posts.show', $comment->post_id)->with('success', '留言已更新');
    }

    /**
     * 刪除留言
     */
    public function destroy(Comment $comment)
    {
        // Policy 已通過 authorizeResource 自動檢查授權
        $this->commentService->deleteComment($comment);

        return redirect()->back()->with('success', '留言已刪除');
    }
}
