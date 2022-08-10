<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class IndexCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:256',
            'description' => 'string|max:500',
        ];
    }
}
