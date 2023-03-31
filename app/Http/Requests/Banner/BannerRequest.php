<?php

namespace App\Http\Requests\Banner;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:4',
                'max:255',
                Rule::unique('banners', 'name')->ignore(request()->id, 'id')
            ],
            'link' => [
                'required',
                'min:6',
                'max:255',
                'string',

            ],
            'file' => [
                'file',
                'mimes:jpeg,jpg,png,gif',
                'max:5000',
                request()->isMethod('POST') ? 'required' : 'nullable'
            ]

        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên banner',
            'link' => 'Đường dẫn banner',
            'file' => 'Ảnh banner',
        ];
    }
}
