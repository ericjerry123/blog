<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LoginService
{
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw new HttpException(401, '帳號或密碼錯誤');
        }

        return redirect()->route('posts.index');
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();
    }
}
