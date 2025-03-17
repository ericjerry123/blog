<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * 判斷用戶是否有權限進行此請求
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Post::class);
    }

    /**
     * 獲取適用於請求的驗證規則
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'status' => 'required|in:draft,published,scheduled',
            'scheduled_for' => 'nullable|required_if:status,scheduled|date|after_or_equal:now',
        ];
    }

    /**
     * 獲取驗證錯誤的自定義消息
     */
    public function messages(): array
    {
        return [
            'scheduled_for.required_if' => '當狀態為排程發布時，必須設定發布時間',
            'scheduled_for.after_or_equal' => '排程發布時間必須是未來的時間',
        ];
    }
}
