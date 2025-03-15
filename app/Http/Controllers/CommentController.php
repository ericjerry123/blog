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
    }

    /**
     * 存儲新創建的留言
     */
    public function store(StoreCommentRequest $request)
    {
        $validatedData = $request->validated();

        $this->commentService->createComment($validatedData);

        return redirect()->back()->with('success', '留言已發布');
    }

    /**
     * 顯示編輯留言的表單
     */
    public function edit(Comment $comment)
    {
        // 驗證用戶是否有權編輯留言
        if ($comment->user_id !== auth()->id()) {
            return redirect()->back()->with('error', '您無權編輯此留言');
        }

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

        $result = $this->commentService->updateComment($comment, $request->only('content'));

        if (!$result) {
            return redirect()->back()->with('error', '您無權更新此留言');
        }

        return redirect()->route('posts.show', $comment->post_id)->with('success', '留言已更新');
    }

    /**
     * 刪除留言
     */
    public function destroy(Comment $comment)
    {
        $result = $this->commentService->deleteComment($comment);

        if (!$result) {
            return redirect()->back()->with('error', '您無權刪除此留言');
        }

        return redirect()->back()->with('success', '留言已刪除');
    }
}
