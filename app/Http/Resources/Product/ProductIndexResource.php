<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use Request;

class ProductIndexResource extends JsonResource
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
            "price" => $this->price,
            "enable" => $this->enable,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
