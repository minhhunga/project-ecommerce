<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale' => 'nullable|numeric|min:0|max:100',
            'id_category' => 'required|exists:category,id',
            'id_brand' => 'required|exists:brand,id',
            'company' => 'required|string|max:255',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'detail' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm.', 
            'price.required' => 'Vui lòng nhập giá sản phẩm.', 
            'price.numeric' => 'Giá sản phẩm phải là số.', 
            'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0.',
            'sale.numeric' => 'Phần trăm giảm giá phải là số.',
            'sale.min' => 'Phần trăm giảm giá phải lớn hơn hoặc bằng 0.',
            'sale.max' => 'Phần trăm giảm giá không được vượt quá 100.' ,
            'id_category.required' => 'Vui lòng chọn danh mục.',
            'id_category.exists' => 'Danh mục đã chọn không hợp lệ.', 
            'id_brand.required' => 'Vui lòng chọn thương hiệu.',
            'id_brand.exists' => 'Thương hiệu đã chọn không hợp lệ.',
            'company.required' => 'Vui lòng nhập tên công ty.', 
            'image.required' => 'Vui lòng tải lên ít nhất một hình ảnh.',
            'image.image' => 'Mỗi tệp tải lên phải là hình ảnh.', 
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif hoặc svg.', 
            'image.max' => 'Mỗi ảnh không được vượt quá 2MB.',
            'detail.string' => 'Vui lòng nhập mô tả sản phẩm .',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá sản phẩm', 
            'sale' => 'Phần trăm giảm giá', 
            'id_category' => 'Danh mục', 
            'id_brand' => 'Thương hiệu', 
            'company' => 'Tên công ty', 
            'image.*' => 'Hình ảnh sản phẩm', 
            'detail' => 'Mô tả sản phẩm',
        ];
    }
}
