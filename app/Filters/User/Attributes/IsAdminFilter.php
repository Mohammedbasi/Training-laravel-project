<?php

namespace App\Filters\User\Attributes;

use App\Filters\User\FilterInterface;

class IsAdminFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('is_admin', '=', $value == 'admin' ? 1 : 0);
    }
}
