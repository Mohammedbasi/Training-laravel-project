<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class SingleNameFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('name', 'LIKE', "%{$value}%");
    }
}
