<?php

namespace App\Filters\User\Attributes;

use App\Filters\User\FilterInterface;

class EmailFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('email', 'LIKE', "%{$value}%");
    }
}
