<?php

namespace Tests\Unit\Services;

use App\Http\Services\LoginService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    use RefreshDatabase;

    private LoginService $loginService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loginService = new LoginService();
    }

    /**
     * 測試登入服務使用正確憑證時成功
     */
    public function test_login_succeeds_with_valid_credentials(): void
    {
        // 創建測試用戶
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // 執行登入方法
        $response = $this->loginService->login([
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        // 確認用戶已經登入
        $this->assertTrue(Auth::check());
        $this->assertEquals($user->id, Auth::id());

        // 確認返回的是重定向響應
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('posts.index'), $response->getTargetUrl());
    }

    /**
     * 測試登入服務使用錯誤憑證時失敗
     */
    public function test_login_fails_with_invalid_credentials(): void
    {
        // 創建測試用戶
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // 期望拋出 HttpException 異常
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('帳號或密碼錯誤');

        // 執行登入方法（使用錯誤密碼）
        $this->loginService->login([
            'email' => 'test@example.com',
            'password' => 'wrong-password'
        ]);

        // 確認用戶未登入
        $this->assertFalse(Auth::check());
    }

    /**
     * 測試登出功能
     */
    public function test_logout_functionality(): void
    {
        // 創建並登入用戶
        $user = User::factory()->create();
        Auth::login($user);
        $this->assertTrue(Auth::check());

        // 設置一些 session 數據
        Session::put('key', 'value');
        $this->assertTrue(Session::has('key'));

        // 執行登出
        $this->loginService->logout();

        // 確認用戶已登出
        $this->assertFalse(Auth::check());

        // 確認 session 已失效
        $this->assertFalse(Session::has('key'));
    }
}
