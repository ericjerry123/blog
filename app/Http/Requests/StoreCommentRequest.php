<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string|min:2|max:1000',
            'post_id' => 'required|exists:posts,id',
            'parent_id' => 'nullable|exists:comments,id',
        ];
    }

    /**
     * 獲取驗證錯誤的自定義消息。
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'content.required' => '留言不能為空',
            'content.min' => '留言至少需要 2 個字符',
            'content.max' => '留言不能超過 1000 個字符',
            'post_id.required' => '文章 ID 不能為空',
            'post_id.exists' => '無效的文章 ID',
            'parent_id.exists' => '無效的父留言 ID',
        ];
    }
}
