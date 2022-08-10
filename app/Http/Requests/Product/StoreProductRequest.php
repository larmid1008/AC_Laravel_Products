<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_ids' => 'array',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ];
    }
}
