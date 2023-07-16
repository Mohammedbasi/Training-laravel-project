<?php

namespace App\Filters\User\Attributes;

use App\Filters\User\FilterInterface;

class UsernameFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('username', 'LIKE', "%{$value}%");
    }
}
