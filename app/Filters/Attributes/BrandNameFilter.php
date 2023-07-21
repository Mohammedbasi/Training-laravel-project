<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class BrandNameFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('brand_id', '=', $value);
    }
}
