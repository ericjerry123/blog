<x-layouts.app>
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">註冊帳戶</h1>
                <p class="py-6">加入我們的社群，開始分享您的想法和故事</p>
            </div>
            <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
                <form method="POST" action="{{ route('register.store') }}" class="card-body">
                    @csrf

                    <div class="form-control">
                        <label class="label" for="name">
                            <span class="label-text">姓名</span>
                        </label>
                        <input type="text" name="name" placeholder="請輸入姓名"
                            class="input input-bordered @error('name') input-error @enderror"
                            value="{{ old('name') }}" required autofocus />
                        @error('name')
                            <label class="label" for="name">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label" for="email">
                            <span class="label-text">電子郵件</span>
                        </label>
                        <input type="email" name="email" placeholder="請輸入電子郵件"
                            class="input input-bordered @error('email') input-error @enderror"
                            value="{{ old('email') }}" required />
                        @error('email')
                            <label class="label" for="email">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label" for="password">
                            <span class="label-text">密碼</span>
                        </label>
                        <input type="password" name="password" placeholder="請輸入密碼"
                            class="input input-bordered @error('password') input-error @enderror" required />
                        @error('password')
                            <label class="label" for="password">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label" for="password_confirmation">
                            <span class="label-text">確認密碼</span>
                        </label>
                        <input type="password" name="password_confirmation" placeholder="請再次輸入密碼"
                            class="input input-bordered" required />
                    </div>

                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">註冊</button>
                    </div>

                    <div class="text-center mt-4">
                        <p>已有帳戶？
                            <a href="#" class="link link-hover link-primary">登入</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
