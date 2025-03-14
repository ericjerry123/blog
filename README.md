# Laravel Blog 開發

## 專案簡介

這是一個使用 Laravel 10 開發的部落格系統，提供完整的文章發布、評論管理、用戶認證等功能。本專案遵循 Laravel 最佳實踐和 SOLID 原則開發，使用 PHP 8.1+ 的新特性。

## 功能列表

### 使用者管理
- 使用者註冊與登入
- 密碼重置功能
- 使用者個人資料管理
- 權限控制

### 文章功能
- 文章的建立、閱讀、更新、刪除 (CRUD)
- 文章分類管理
- 文章標籤系統
- 文章搜尋和過濾

### 留言功能
- 文章留言的建立、閱讀、更新、刪除 (CRUD)
- 留言分頁

## 技術堆疊

- **PHP 8.1+**
- **Laravel 10**
- **MySQL** 資料庫
- **Blade** 模板引擎
- **Bootstrap 5** 前端框架
- **Eloquent ORM** 數據庫交互
- **Laravel Mix** 資源編譯

## 安裝步驟

### 系統需求
- PHP 8.1 或更高版本
- Composer
- MySQL 或 MariaDB
- Node.js 與 NPM

### 安裝指南

1. 複製專案
```bash
git clone https://github.com/yourusername/laravel-blog.git
cd laravel-blog
```

2. 安裝依賴
```bash
composer install
npm install
```

3. 環境設定
```bash
cp .env.example .env
php artisan key:generate
```

4. 設定資料庫
   - 在 `.env` 文件中設定資料庫連線資訊
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_blog
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. 執行遷移和種子資料
```bash
php artisan migrate
php artisan db:seed
```

6. 編譯前端資源
```bash
npm run dev
```

7. 啟動開發伺服器
```bash
php artisan serve
```

現在，你可以在瀏覽器中訪問 `http://localhost:8000` 來查看部落格系統。

## 開發指南

### 資料結構

本專案包含以下主要資料表：
- `users` - 儲存使用者資訊
- `posts` - 儲存文章內容
- `comments` - 儲存文章留言
- `categories` - 文章分類
- `tags` - 文章標籤
- `post_tag` - 文章與標籤的多對多關聯

### 目錄結構

```
app/
├── Http/
│   ├── Controllers/  # 控制器
│   ├── Middleware/   # 中間件
│   └── Requests/     # 表單請求驗證
├── Models/           # Eloquent 模型
├── Policies/         # 授權政策
└── Repositories/     # 資料存取層
resources/
├── views/            # Blade 模板
└── js/               # JavaScript
```

## 功能使用說明

### 管理員帳號

預設管理員帳號：
- 電子郵件: admin@example.com
- 密碼: password

### 文章管理

文章管理功能可在登入後從儀表板訪問，支援:
- 創建新文章
- 編輯現有文章
- 設定文章分類和標籤
- 刪除文章

### 留言管理

留言功能允許:
- 登入用戶在文章下方發表留言
- 僅留言作者或管理員可編輯/刪除留言

## 測試

執行單元測試:
```bash
php artisan test
```

## 部署

### 生產環境設定建議
- 啟用 OPcache
- 設定適當的緩存驅動 (Redis 推薦)
- 設定隊列工作者處理後台任務

## 授權條款

本專案採用 MIT 授權條款 - 詳情參見 [LICENSE](LICENSE) 文件。

## 貢獻指南

1. Fork 本專案
2. 創建特性分支 (`git checkout -b feature/amazing-feature`)
3. 提交變更 (`git commit -m 'Add some amazing feature'`)
4. 推送到分支 (`git push origin feature/amazing-feature`)
5. 開啟 Pull Request 