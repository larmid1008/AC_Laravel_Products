<?php

namespace App\Http\Dto\Product;

use Spatie\DataTransferObject\DataTransferObject;

class CreateProductCommand extends DataTransferObject
{
    public string $name;
    public ?string $description;
    public float $price;
    public bool $published;
    public array $categoriesId = [];
}
