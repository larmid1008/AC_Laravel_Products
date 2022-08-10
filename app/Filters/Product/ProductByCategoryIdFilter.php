<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ProductByCategoryIdFilter implements Filter
{
    public function __invoke(Builder $query, $categoryIds, string $property)
    {
        $query->whereHas('categories', function (Builder $builder) use ($categoryIds) {
            $builder->whereIn('id', is_array($categoryIds) ? $categoryIds : [$categoryIds]);
        });
    }
}
