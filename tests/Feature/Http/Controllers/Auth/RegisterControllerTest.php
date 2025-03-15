<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * 測試註冊頁面是否可以正確顯示
     */
    public function test_registration_page_can_be_rendered(): void
    {
        $response = $this->get(route('register.create'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    /**
     * 測試用戶可以成功註冊
     */
    public function test_new_users_can_register(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect(route('login.create'));
    }

    /**
     * 測試用戶無法使用已存在的電子郵件註冊
     */
    public function test_users_cannot_register_with_existing_email(): void
    {
        User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $response = $this->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'existing@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseCount('users', 1);

        $response->assertRedirect();

        $response->assertSessionHasErrors('email');
    }

    /**
     * 測試密碼確認不匹配時無法註冊
     */
    public function test_users_cannot_register_with_password_mismatch(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'different-password',
        ]);

        $this->assertDatabaseCount('users', 0);

        $response->assertRedirect();

        $response->assertSessionHasErrors('password');
    }

    /**
     * 測試缺少必填字段時無法註冊
     */
    public function test_users_cannot_register_with_missing_fields(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);

        $this->assertDatabaseCount('users', 0);
    }
}
