<?php

namespace App\Http\Handlers\Category;

use App\Http\Dto\Category\CreateCategoryCommand;
use App\Models\Category;
use App\Http\Handlers\BaseHandler;

class CreateCategoryHandler extends BaseHandler
{
    /**
     * @param CreateCategoryCommand $command
     * @return Category
     */
    protected function handleCommand($command): Category
    {
        return Category::create([
            "name" => $command->name,
            "description" => $command->description,
            "published" => $command->published,
            "price" => $command->price,
        ]);
    }
}
