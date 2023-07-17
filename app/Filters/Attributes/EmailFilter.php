<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class EmailFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('email', 'LIKE', "%{$value}%");
    }
}
