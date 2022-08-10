<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\PaginationRequest;

class IndexCategoryRequest extends PaginationRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string|max:255',
            'description' => 'string',
        ];
    }
}
