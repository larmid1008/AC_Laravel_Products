<?php

namespace App\Http\Dto\Category;

use Spatie\DataTransferObject\DataTransferObject;

class CreateCategoryCommand extends DataTransferObject
{
    public string $name;
    public string $description;
}
