<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class PhoneFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('phone', '=', $value);
    }
}
