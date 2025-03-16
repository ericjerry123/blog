<?php

namespace App\Http\Repositories;

use App\Models\User;

class RegisterRepository
{
    /**
     * 註冊用戶
     *
     * @param array $credentials
     * @return void
     */
    public function register(array $credentials)
    {
        User::create($credentials);
    }
}
