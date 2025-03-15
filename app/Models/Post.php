<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 獲取文章的留言
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    /**
     * 獲取文章的所有留言（包括回覆）
     */
    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * 獲取文章的分類
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
