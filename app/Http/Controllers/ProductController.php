<?php

namespace App\Http\Controllers;

use App\Http\Handlers\Product\CreateProductHandler;
use App\Http\Handlers\Product\UpdateProductHandler;
use App\Http\Dto\Product\CreateProductCommand;
use App\Http\Dto\Product\UpdateProductCommand;
use App\Http\Requests\Product\IndexProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Resources\Product\ProductIndexResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(IndexProductRequest $request): ResourceCollection
    {
        return JsonResource::collection(
            Product::orderBy('id')
                ->limit(config('const.ITEM_LIMIT'))
                ->offset($request->offset)
                ->get()
        );
    }

    public function show(Product $item): JsonResource
    {
        return new JsonResource($item);
    }

    public function store(
        StoreProductRequest $request,
        CreateProductHandler $handler,
    ): ProductIndexResource {
        $command = new CreateProductCommand(
            name: $request->get('name'),
            description: $request->get('description'),
            price: $request->get('price'),
            enable: $request->get('enable'),
        );

        $product = $handler->handle($command);

        return ProductIndexResource::make($product);
    }

    public function update(
        int $id,
        StoreProductRequest $request,
        UpdateProductHandler $handler,
    ): ProductIndexResource {
        $command = new UpdateProductCommand(
            id: $id,
            name: $request->get('name'),
            description: $request->get('description'),
            price: $request->get('price'),
            enable: $request->get('enable'),
        );

        $handler->handle($command);
        $product = Product::findOrFail($id);

        return ProductIndexResource::make($product);
    }

    public function destroy(int $id, Request $request, Product $product): Response
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->noContent();
    }
}
