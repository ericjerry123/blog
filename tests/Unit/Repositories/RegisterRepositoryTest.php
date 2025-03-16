<?php

namespace Tests\Unit\Repositories;

use App\Http\Repositories\RegisterRepository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private RegisterRepository $registerRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->registerRepository = new RegisterRepository();
    }

    /**
     * 測試註冊資料庫操作正確創建用戶
     */
    public function test_register_creates_user_in_database(): void
    {
        // 準備測試數據
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ];

        // 執行註冊方法
        $this->registerRepository->register($userData);

        // 檢查數據庫中是否有該用戶
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 檢查數據庫記錄數量
        $this->assertDatabaseCount('users', 1);

        // 檢查返回的用戶模型是否正確
        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Test User', $user->name);
    }

    /**
     * 測試註冊資料庫操作處理重複電子郵件
     */
    public function test_register_should_throw_exception_on_duplicate_email(): void
    {
        // 創建已存在的用戶
        User::factory()->create([
            'email' => 'existing@example.com'
        ]);

        // 準備重複的測試數據
        $userData = [
            'name' => 'Another User',
            'email' => 'existing@example.com',
            'password' => bcrypt('password123'),
        ];

        // 使用 try-catch 捕獲異常
        $exceptionThrown = false;
        try {
            $this->registerRepository->register($userData);
        } catch (\Exception $e) {
            $exceptionThrown = true;
            $this->assertInstanceOf(\Illuminate\Database\QueryException::class, $e);
        }

        // 確認異常被拋出
        $this->assertTrue($exceptionThrown, '預期應該拋出異常，但沒有拋出');

        // 確認數據庫中只有一個用戶
        $this->assertDatabaseCount('users', 1);
    }
}
