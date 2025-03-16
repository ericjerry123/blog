<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 先創建分類
        $this->call(CategorySeeder::class);

        // 創建用戶和文章
        User::factory(10)->hasPosts(3)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 將文章與分類關聯
        $this->call(PostCategorySeeder::class);
    }
}
