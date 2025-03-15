<x-layouts.app>
    <x-layouts.auth>
        <x-auth.header title="登入帳戶" description="歡迎回來，請輸入您的帳號資訊" />

        <x-auth.card action="{{ route('login.store') }}" method="POST">
            @csrf

            <x-form.input type="email" name="email" label="電子郵件" placeholder="請輸入電子郵件" value="{{ old('email') }}"
                required autofocus />

            <x-form.input type="password" name="password" label="密碼" placeholder="請輸入密碼" required />

            <div class="form-control">
                <label class="label cursor-pointer justify-start gap-2">
                    <input type="checkbox" name="remember" class="checkbox checkbox-primary"
                        {{ old('remember') ? 'checked' : '' }} />
                    <span class="label-text">記住我</span>
                </label>
            </div>

            <x-form.button>登入</x-form.button>

            <div class="text-center mt-4">
                <p>還沒有帳戶？
                    <a href="{{ route('register.create') }}" class="link link-hover link-primary">註冊</a>
                </p>
            </div>
        </x-auth.card>
    </x-layouts.auth>
</x-layouts.app>
