<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'post_id',
        'user_id',
        'parent_id',
    ];

    /**
     * 獲取留言所屬的文章
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * 獲取撰寫留言的用戶
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 獲取留言的父留言
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * 獲取留言的回覆
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
