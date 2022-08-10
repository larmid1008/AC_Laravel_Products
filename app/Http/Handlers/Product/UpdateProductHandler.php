<?php

namespace App\Http\Handlers\Product;

use App\Http\Dto\Product\CreateProductCommand;
use App\Models\Product;
use App\Http\Handlers\BaseHandler;

class UpdateProductHandler extends BaseHandler
{
    /**
     * @param CreateProductCommand $command
     * @return Product
     */
    protected function handleCommand($command): Product
    {
        $business = Product::findOrFail($command->id);
        //$this->isUnique($command);

        $business->updateOrFail([
            "name" => $command->name,
            "description" => $command->description,
            "published" => $command->published,
            "price" => $command->price,
        ]);
        return $business;
    }
}
