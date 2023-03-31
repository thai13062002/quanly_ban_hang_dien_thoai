<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColorProductDetailRequest extends FormRequest
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
            'color_id' => ['required', 'numeric', Rule::unique('color_product_detail', 'color_id')->where(function ($query) use ($request) {
                return $query->where('product_id', $request->product_id);
            })],
            'quantity' => ['required', 'numeric', 'min:1', 'max:11'],
            // 'photo.*' =>  'required|file|mimes:jpeg,jpg,png,gif',
        ];
    }

    public function attributes()
    {
        return [
            'color_id' => 'Màu sắc',
            'quantity' => 'Số lượng',
        ];
    }
}
