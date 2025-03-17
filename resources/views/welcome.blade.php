<!DOCTYPE html>
<html lang="zh-TW" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的部落格</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-base-200">
    <!-- 導航欄 -->
    <div class="navbar bg-base-100 shadow-lg">
        <div class="navbar-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="#features">功能特點</a></li>
                    <li><a href="#about">關於我們</a></li>
                    <li><a href="#contact">聯絡我們</a></li>
                </ul>
            </div>
            <a class="btn btn-ghost normal-case text-xl">我的部落格</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="#features">功能特點</a></li>
                <li><a href="#about">關於我們</a></li>
                <li><a href="#contact">聯絡我們</a></li>
            </ul>
        </div>
        <div class="navbar-end">
            <a href="{{ route('login.create') }}" class="btn btn-primary">登入</a>
        </div>
    </div>

    <!-- 主要內容區 -->
    <div class="hero min-h-[calc(100vh-4rem)] bg-base-200">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold">歡迎來到我的部落格</h1>
                <p class="py-6">這是一個使用 Laravel 和 DaisyUI 建立的現代化部落格平台。在這裡，您可以分享想法、記錄生活，並與他人交流。</p>
                <a href="{{ route('register.create') }}" class="btn btn-primary">立即註冊</a>
            </div>
        </div>
    </div>

    <!-- 功能特點區 -->
    <div id="features" class="py-16 bg-base-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">功能特點</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card bg-base-200 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title">文章管理</h3>
                        <p>輕鬆創建、編輯和管理您的部落格文章</p>
                    </div>
                </div>
                <div class="card bg-base-200 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title">分類系統</h3>
                        <p>使用分類系統組織您的文章內容</p>
                    </div>
                </div>
                <div class="card bg-base-200 shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title">評論功能</h3>
                        <p>與讀者互動，建立社群討論</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 頁尾 -->
    <footer class="footer footer-center p-10 bg-base-200 text-base-content rounded">
        <div>
            <p>Copyright © 2024 - 我的部落格</p>
            <p>使用 Laravel 和 DaisyUI 建立</p>
        </div>
    </footer>
</body>

</html>
