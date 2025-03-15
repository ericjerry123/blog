<x-layouts.app>
    <x-layouts.auth>
        <x-auth.header
            title="註冊帳戶"
            description="加入我們的社群，開始分享您的想法和故事"
        />

        <x-auth.card action="{{ route('register.store') }}">
            @csrf

            <x-form.input
                name="name"
                label="姓名"
                placeholder="請輸入姓名"
                value="{{ old('name') }}"
                required
                autofocus
            />

            <x-form.input
                type="email"
                name="email"
                label="電子郵件"
                placeholder="請輸入電子郵件"
                value="{{ old('email') }}"
                required
            />

            <x-form.input
                type="password"
                name="password"
                label="密碼"
                placeholder="請輸入密碼"
                required
            />

            <x-form.input
                type="password"
                name="password_confirmation"
                label="確認密碼"
                placeholder="請再次輸入密碼"
                required
            />

            <x-form.button>註冊</x-form.button>

            <div class="text-center mt-4">
                <p>已有帳戶？
                    <a href="#" class="link link-hover link-primary">登入</a>
                </p>
            </div>
        </x-auth.card>
    </x-layouts.auth>
</x-layouts.app>
