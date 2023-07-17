<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class IsAdminFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('is_admin', '=', $value == 'admin' ? 1 : 0);
    }
}
