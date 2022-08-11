<?php

namespace App\Http\Handlers\Product;

use App\Http\Dto\Product\CreateProductCommand;
use App\Models\Category;
use App\Models\Product;
use App\Http\Handlers\BaseHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreateProductHandler extends BaseHandler
{
    /**
     * @param CreateProductCommand $command
     * @return Product
     */
    protected function handleCommand($command): Product
    {
        $categoriesId = Category::whereIn('id', $command->categoriesId)->pluck('id');
        $wrongIds = array_diff($command->categoriesId, $categoriesId->toArray());

        if (count($wrongIds)) {
            throw new NotFoundHttpException(
                sprintf(
                    "Categories with ids '%s' not found",
                    collect($wrongIds)->join(', ')
                )
            );
        }

        $product = Product::create([
            "name" => $command->name,
            "description" => $command->description,
            "published" => $command->published,
            "price" => $command->price,
        ]);

        $product->categories()->sync($command->categoriesId);

        return $product->load('categories');
    }
}
