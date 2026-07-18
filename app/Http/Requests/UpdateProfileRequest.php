<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'required|string|max:30',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user()->id,
            'password' => 'nullable|string|min:8',
            'phone' => 'nullable|string|max:11',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống.',
            'name.string' => 'Tên phải là một chuỗi.',
            'name.max' => 'Tên không được vượt quá 30 ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'email.in' => 'Bạn không được phép thay đổi địa chỉ email.',
            'email.unique' => 'Email đã tồn tại.',
            'password.string' => 'Mật khẩu phải là một chuỗi.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'phone.string' => 'Số điện thoại phải là một chuỗi.',
            'phone.max' => 'Số điện thoại không được vượt quá 10 số.',
            'avatar.image' => 'Ảnh đại diện phải là một hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng: jpeg, png, jpg, gif, svg.',
            'avatar.max' => 'Ảnh đại diện không được vượt quá 2MB.',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'phone' => 'Số điện thoại',
            'avatar' => 'Ảnh đại diện',
        ];
    }
}
