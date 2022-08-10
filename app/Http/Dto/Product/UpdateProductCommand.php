<?php

namespace App\Http\Dto\Product;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateProductCommand extends DataTransferObject
{
    public int $id;
    public string $name;
    public string $description;
    public float $price;
    public bool $enable;
    public array $category_ids;
}
