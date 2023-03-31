<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductDetailRequest extends FormRequest
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
        $request = request();
        return [
            'capacity' => ['required', Rule::unique('product_detail', 'capacity')->where(function ($query) use ($request) {
                return $query->where('product_id', $request->product_id);
            })],
            'price_import' => ['required', 'integer','numeric', 'min:1', 'max:11', 'lt:price_sell'],
            'price_sell' => ['required', 'numeric', 'min:1', 'max:11', 'gt:price_import'],
            'img.*' =>  request('id') ? '' : 'required|file|mimes:jpeg,jpg,png,gif|max:5000',
        ];
    }
    public function attributes()
    {
        return [
            'capacity' => 'Dung lượng',
            'price_import' => 'Giá nhập',
            'price_sell' => 'Giá bán',
            'img' => 'Ảnh'
        ];
    }
}
