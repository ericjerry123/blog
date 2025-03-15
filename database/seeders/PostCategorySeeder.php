<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 獲取所有文章和分類
        $posts = Post::all();
        $categories = Category::all();

        // 確保有文章和分類
        if ($posts->isEmpty() || $categories->isEmpty()) {
            return;
        }

        // 為每篇文章隨機分配 1-3 個分類
        foreach ($posts as $post) {
            // 隨機選擇 1-3 個分類
            $randomCategories = $categories->random(rand(1, min(3, $categories->count())));

            // 獲取分類 ID
            $categoryIds = $randomCategories->pluck('id')->toArray();

            // 將文章與分類關聯
            $post->categories()->sync($categoryIds);
        }
    }
}
