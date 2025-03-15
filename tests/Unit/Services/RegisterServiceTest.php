<?php

namespace Tests\Unit\Services;

use App\Http\Repositories\RegisterRepository;
use App\Http\Services\RegisterService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class RegisterServiceTest extends TestCase
{
    use RefreshDatabase;

    private RegisterService $registerService;
    /** @var RegisterRepository|MockInterface */
    private $registerRepository;

    protected function setUp(): void
    {
        parent::setUp();

        // 模擬 RegisterRepository
        $this->registerRepository = Mockery::mock(RegisterRepository::class);
        $this->registerService = new RegisterService($this->registerRepository);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * 測試註冊服務正確儲存用戶
     */
    public function test_register_stores_user(): void
    {
        // 測試數據
        $credentials = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        // 預期 repository 會接收到原始數據
        $this->registerRepository->shouldReceive('register')
            ->once()
            ->withArgs(function ($arg) use ($credentials) {
                // 確認所有數據保持不變
                $this->assertEquals($credentials['name'], $arg['name']);
                $this->assertEquals($credentials['email'], $arg['email']);
                $this->assertEquals($credentials['password'], $arg['password']);

                return true;
            });

        // 執行註冊方法
        $this->registerService->register($credentials);
    }

    /**
     * 整合測試 - 測試完整的註冊流程（不使用 mock）
     */
    public function test_integration_register_creates_user_in_database(): void
    {
        // 創建真實的 repository
        $realRepository = new RegisterRepository();
        $service = new RegisterService($realRepository);

        // 測試數據
        $credentials = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ];

        // 執行註冊
        $service->register($credentials);

        // 確認用戶已創建
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 使用 Auth::attempt 驗證密碼是否正確
        $this->assertTrue(Auth::attempt([
            'email' => 'test@example.com',
            'password' => 'password123'
        ]));
    }
}
