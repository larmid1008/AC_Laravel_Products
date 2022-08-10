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
        // TODO check if category name is unique
        //$this->isUnique($command);

        return Category::create([
            "name" => $command->name,
            "description" => $command->description,
        ]);
    }
}
