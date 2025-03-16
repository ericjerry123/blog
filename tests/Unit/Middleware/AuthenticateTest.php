<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\Authenticate;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    private $auth;

    protected function setUp(): void
    {
        parent::setUp();
        $this->auth = Mockery::mock(Auth::class);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * 測試未認證的 API 請求不會被重定向
     */
    public function test_unauthenticated_api_requests_are_not_redirected(): void
    {
        $middleware = $this->app->make(Authenticate::class);
        $request = Request::create('/api/user', 'GET');
        $request->headers->set('Accept', 'application/json');

        $redirectTo = $this->callProtectedMethod($middleware, 'redirectTo', [$request]);

        $this->assertNull($redirectTo);
    }

    /**
     * 測試未認證的 Web 請求被重定向到登入頁面
     */
    public function test_unauthenticated_web_requests_are_redirected_to_login(): void
    {
        $middleware = $this->app->make(Authenticate::class);
        $request = Request::create('/dashboard', 'GET');

        $redirectTo = $this->callProtectedMethod($middleware, 'redirectTo', [$request]);

        $this->assertEquals(route('login.create'), $redirectTo);
    }

    /**
     * 調用對象的受保護方法
     *
     * @param object $object 要調用其方法的對象
     * @param string $method 方法名稱
     * @param array $args 方法參數
     * @return mixed 方法返回值
     */
    protected function callProtectedMethod($object, $method, array $args = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $args);
    }
}
