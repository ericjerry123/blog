<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegisterRequest;
use App\Http\Services\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private RegisterService $registerService;
    public function __construct(
        RegisterService $registerService
    ) {
        $this->registerService = $registerService;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * 使用者註冊
     *
     * @param StoreRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRegisterRequest $request)
    {
        $credentials = $request->only('name', 'email', 'password');

        try {
            $this->registerService->register($credentials);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        /**TODO: 回傳註冊成功訊息 */
        return redirect()->route('login.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
