<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ProductByNameFilter implements Filter
{
    public function __invoke(Builder $query, $productName, string $property)
    {
        $query->where('name', 'like', $productName);
    }
}
