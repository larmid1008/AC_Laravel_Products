<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\PaginationRequest;

class IndexProductRequest extends PaginationRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
