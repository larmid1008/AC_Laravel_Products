<?php

namespace App\Http\Handlers\Product;

use App\Http\Dto\Product\CreateProductCommand;
use App\Models\Product;
use App\Http\Handlers\BaseHandler;

class CreateProductHandler extends BaseHandler
{
    /**
     * @param CreateProductCommand $command
     * @return Product
     */
    protected function handleCommand($command): Product
    {
        return Product::create([
            "name" => $command->name,
            "description" => $command->description,
            "enable" => $command->enable,
            "price" => $command->price,
        ]);
    }
}
