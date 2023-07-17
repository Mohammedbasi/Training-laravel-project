<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class IsActiveFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('is_active', '=', $value == 'active' ? 1 : 0);
    }
}
