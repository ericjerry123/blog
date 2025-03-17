<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'user_id',
        'scheduled_for',
        'status',
    ];

    protected $casts = [
        'scheduled_for' => 'datetime',
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

    /**
     * 範圍查詢：僅獲取已發布的文章
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * 範圍查詢：僅獲取草稿文章
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * 範圍查詢：僅獲取已排程的文章
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    /**
     * 範圍查詢：獲取應該發布的已排程文章
     */
    public function scopeDueForPublishing($query)
    {
        return $query->where('status', 'scheduled')
                     ->where('scheduled_for', '<=', Carbon::now());
    }

    /**
     * 將文章標記為已發布
     */
    public function markAsPublished()
    {
        $this->status = 'published';
        $this->save();

        return $this;
    }
}
