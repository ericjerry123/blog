<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * 獲取屬於此分類的文章
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
