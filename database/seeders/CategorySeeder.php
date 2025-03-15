<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => '技術',
                'slug' => 'technology',
                'description' => '技術相關的文章和教程',
            ],
            [
                'name' => '生活',
                'slug' => 'lifestyle',
                'description' => '生活經驗和心得分享',
            ],
            [
                'name' => '旅遊',
                'slug' => 'travel',
                'description' => '旅遊景點和經驗分享',
            ],
            [
                'name' => '美食',
                'slug' => 'food',
                'description' => '各地美食推薦和食譜',
            ],
            [
                'name' => '健康',
                'slug' => 'health',
                'description' => '健康知識和保健秘訣',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
            ]);
        }
    }
}
