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
            'name' => 'required|string|max:255',
            'description' => 'string|max:512',
            'price' => 'required|numeric',
            'categories_id' => 'required|array|min:2|max:10',
            'published' => 'boolean',
        ];
    }
}
