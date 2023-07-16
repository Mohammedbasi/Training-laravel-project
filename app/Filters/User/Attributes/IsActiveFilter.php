<?php

namespace App\Filters\User\Attributes;

use App\Filters\User\FilterInterface;

class IsActiveFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('is_active', '=', $value == 'active' ? 1 : 0);
    }
}
