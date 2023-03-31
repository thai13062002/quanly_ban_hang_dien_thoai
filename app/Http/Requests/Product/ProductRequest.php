<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'brand_id' => ['required'],
            'cat_id' => ['required'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['required', 'string', 'min:6', 'max:255'],
            'img' =>  request('id') ? '' : 'required|file|mimes:jpeg,jpg,png,gif|max:5000',
        ];
    }
    public function attributes()
    {
        return [
            'brand_id' => 'Nhãn hàng',
            'cat_id' => 'Thể loại',
            'name' => 'Tên',
            'description' => 'Mô tả',
            'img' => 'Ảnh'
        ];
    }
}
