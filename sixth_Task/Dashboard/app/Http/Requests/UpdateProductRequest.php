<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name_en' => ['required', 'string', 'max:256', 'min:5'],
            'name_ar' => ['required', 'string', 'max:256', 'min:5'],
            'price' => ['required', 'numeric', 'max:99999.99', 'min:10'],
            'code' => ['required', 'integer', 'digits:5', "unique:products,code"],
            'quantity' => ['nullable', 'integer', 'max:999', 'min:1'],
            'desc_en' => ['required', 'string'],
            'desc_ar' => ['required', 'string'],
            'status' => ['required', 'integer', 'between:0,1'],
            'subcategory_id' => ['required', 'integer', 'exsits:subcategories,id'],
            'brand_id' => ['required', 'integer', 'exists:brands,id'],
            'image' => ['nullable', 'max:1000', 'mimes:png,jpg,jpeg']
        ];
    }
}
