<?php

namespace App\Http\Controllers;

use App\Http\Dto\Category\CreateCategoryCommand;
use App\Http\Dto\Category\UpdateCategoryCommand;
use App\Http\Handler\Category\UpdateCategoryHandler;
use App\Http\Handlers\Category\CreateCategoryHandler;
use App\Http\Requests\Category\IndexCategoryRequest;
use CategoryIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(IndexCategoryRequest $request): ResourceCollection
    {
        return JsonResource::collection(
            Category::orderBy('id')
                ->limit(config('const.ITEM_LIMIT'))
                ->offset($request->offset)
                ->get()
        );
    }

    public function show(Category $category): JsonResource
    {
        return new JsonResource($category);
    }

    public function store(
        StoreCategoryRequest $request,
        CreateCategoryHandler $handler,
    ): JsonResource {
        $command = new CreateCategoryCommand(
            name: $request->get('name'),
            description: $request->get('description')
        );

        $product = $handler->handle($command);

        return CategoryIndexResource::make($product);
    }

    public function update(
        int $id,
        StoreCategoryRequest $request,
        UpdateCategoryHandler $handler,
    ): JsonResource {
        $command = new UpdateCategoryCommand(
            id: $id,
            name: $request->get('name'),
            description: $request->get('description'),
            price: $request->get('price'),
            published: $request->get('published'),
        );

        $handler->handle($command);
        $category = Category::findOrFail($id);

        return CategoryIndexResource::make($category);
    }

    public function destroy(int $id, Request $request, Category $category): Response
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->noContent();
    }
}
