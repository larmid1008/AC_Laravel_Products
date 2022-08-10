<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'page_size' => 'int|max:100',
        ];
    }

    public function perPage(): ?int
    {
        return $this->get('page_size', 20);
    }

    public function page(): ?int
    {
        return $this->get('page', null);
    }

    public function offset(): ?int
    {
        return $this->get('offset', null);
    }
}
