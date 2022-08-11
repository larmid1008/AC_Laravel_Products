<?php

namespace App\Http\Controllers;

use App\Http\Dto\Category\CreateCategoryCommand;
use App\Http\Dto\Category\UpdateCategoryCommand;
use App\Http\Handlers\Category\UpdateCategoryHandler;
use App\Http\Handlers\Category\CreateCategoryHandler;
use App\Http\Requests\Category\IndexCategoryRequest;
use App\Http\Resources\Category\CategoryIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function index(IndexCategoryRequest $request): ResourceCollection
    {
        $categories = QueryBuilder::for(Category::class)
            ->paginate(perPage: $request->perPage(), page: $request->page());

        return CategoryIndexResource::collection($categories);
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
