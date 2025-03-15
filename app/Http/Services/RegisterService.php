<?php

namespace App\Http\Services;

use App\Http\Repositories\RegisterRepository;

class RegisterService
{
    private RegisterRepository $registerRepository;
    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    /**
     * 註冊用戶
     *
     * @param array $credentials
     * @return void
     */
    public function register(array $credentials)
    {
        $this->registerRepository->register($credentials);
    }
}
