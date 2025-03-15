<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * 判斷用戶是否有權限進行此請求
     */
    public function authorize(): bool
    {
        $post = $this->route('post');
        return $this->user()->can('update', $post);
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
        ];
    }
}
