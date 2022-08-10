<?php

namespace App\Http\Resources\Category;

use http\Client\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIndexResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
