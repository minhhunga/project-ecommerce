<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'content' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'title.string' => 'Tiêu đề phải là một chuỗi ký tự.',
            'title.max' => 'Tiêu đề không được vượt quá 50 ký tự.',
            
            'image.required' => 'Vui lòng chọn hình ảnh.',
            'image.image' => 'Tệp tải lên phải là một định dạng ảnh.',
            'image.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif, hoặc svg.',
            'image.max' => 'Kích thước ảnh không được vượt quá 2048 KB (2MB).',
            
            'description.required' => 'Vui lòng nhập mô tả.',
            'description.string' => 'Mô tả phải là một chuỗi ký tự.',
            
            'content.required' => 'Vui lòng nhập nội dung.',
            'content.string' => 'Nội dung phải là một chuỗi ký tự.',
        ];     
    }

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề',
            'image' => 'Hình ảnh',
            'description' => 'Mô tả',
            'content' => 'Nội dung',
        ];
    }
}
