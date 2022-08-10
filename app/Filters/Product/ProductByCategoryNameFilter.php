<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ProductByCategoryNameFilter implements Filter
{
    public function __invoke(Builder $query, $categoryName, string $property)
    {
        $query->whereHas('categories', function (Builder $builder) use ($categoryName) {
            $builder->where('name', 'like', "%$categoryName%");
        });
    }
}
