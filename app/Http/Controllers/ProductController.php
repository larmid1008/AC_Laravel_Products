<?php

namespace App\Http\Controllers;

use App\Filters\Product\ProductByCategoryIdFilter;
use App\Filters\Product\ProductByCategoryNameFilter;
use App\Filters\Product\ProductByNameFilter;
use App\Filters\Product\ProductDeletedFilter;
use App\Filters\Product\ProductNotDeletedFilter;
use App\Http\Handlers\Product\CreateProductHandler;
use App\Http\Handlers\Product\UpdateProductHandler;
use App\Http\Dto\Product\CreateProductCommand;
use App\Http\Dto\Product\UpdateProductCommand;
use App\Http\Requests\Product\IndexProductRequest;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Resources\Product\ProductIndexResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    public function index(IndexProductRequest $request): AnonymousResourceCollection
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::custom('name', new ProductByNameFilter),
                AllowedFilter::callback('price_from', function (Builder $builder, $value) {
                    $builder->where('price', '>=', $value);
                }),
                AllowedFilter::callback('price_to', function (Builder $builder, $value) {
                    $builder->where('price', '<=', $value);
                }),
                AllowedFilter::custom('deleted_at', new ProductNotDeletedFilter),
                AllowedFilter::custom('category_id', new ProductByCategoryIdFilter),
                AllowedFilter::custom('category_name', new ProductByCategoryNameFilter),
                AllowedFilter::trashed(),
                AllowedFilter::callback('published', function (Builder $builder, $value) {
                    $builder->where('published', '=', $value);
                }),
            ])
            ->with('categories')
            ->paginate(perPage: $request->perPage(), page: $request->page());

        return ProductIndexResource::collection($products);
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
            published: $request->get('published'),
            categoriesId: $request->get('categories_id')
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
            published: $request->get('published'),
            categoriesId: $request->get('categories_id')
        );

        $handler->handle($command);
        $product = Product::findOrFail($id);

        return ProductIndexResource::make($product)->response()->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(int $id, Request $request, Product $product): Response
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->noContent();
    }
}
