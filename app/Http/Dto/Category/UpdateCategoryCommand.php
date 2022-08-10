<?php

namespace App\Http\Dto\Category;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateCategoryCommand extends DataTransferObject
{
    public int $id;
    public string $name;
    public string $description;
}
