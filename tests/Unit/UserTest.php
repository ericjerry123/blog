<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 測試用戶模型具有預期的可填充屬性
     */
    public function test_user_has_expected_fillable_attributes(): void
    {
        $user = new User();

        $this->assertEquals([
            'name',
            'email',
            'password',
        ], $user->getFillable());
    }

    /**
     * 測試用戶模型具有預期的隱藏屬性
     */
    public function test_user_has_expected_hidden_attributes(): void
    {
        $user = new User();

        $this->assertEquals([
            'password',
            'remember_token',
        ], $user->getHidden());
    }

    /**
     * 測試用戶模型的屬性類型轉換
     */
    public function test_user_has_expected_casts(): void
    {
        $user = new User();
        $casts = $user->getCasts();

        $this->assertArrayHasKey('email_verified_at', $casts);
        $this->assertEquals('datetime', $casts['email_verified_at']);
    }

    /**
     * 測試用戶與文章的關聯
     */
    public function test_user_has_posts_relationship(): void
    {
        // 創建一個用戶和多篇文章
        $user = User::factory()->create();
        $posts = Post::factory()->count(3)->create(['user_id' => $user->id]);

        // 確認關聯正確且類型正確
        $this->assertInstanceOf(Collection::class, $user->posts);
        $this->assertCount(3, $user->posts);
        $this->assertInstanceOf(Post::class, $user->posts->first());
    }

    /**
     * 測試密碼自動哈希功能
     */
    public function test_password_is_automatically_hashed(): void
    {
        $plainPassword = 'password123';

        // 使用 create 方法創建用戶，這會觸發 Laravel 的密碼哈希機制
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => $plainPassword
        ]);

        // 重新從數據庫獲取用戶以確保密碼已被哈希
        $user = User::where('email', 'test@example.com')->first();

        // 密碼應該已被哈希（不應該等於原始密碼）
        $this->assertNotEquals($plainPassword, $user->password);
        // 原始密碼應該可以通過哈希值驗證
        $this->assertTrue(password_verify($plainPassword, $user->password));
    }
}
