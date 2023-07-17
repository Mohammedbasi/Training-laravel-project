<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class UsernameFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('username', 'LIKE', "%{$value}%");
    }
}
