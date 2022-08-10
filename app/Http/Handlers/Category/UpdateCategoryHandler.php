<?php

namespace App\Http\Handler\Category;

use App\Http\Dto\Category\CreateCategoryCommand;
use App\Models\Category;
use App\Http\Handlers\BaseHandler;

class UpdateCategoryHandler extends BaseHandler
{
    /**
     * @param CreateCategoryCommand $command
     * @return Category
     */
    protected function handleCommand($command): Category
    {
        $category = Category::findOrFail($command->id);
        //$this->isUnique($command);

        $category->updateOrFail([
            "name" => $command->name,
            "description" => $command->description,
        ]);

        return $category;
    }
}
