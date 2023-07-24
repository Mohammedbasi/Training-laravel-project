<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class CityNameFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('city_id', '=', $value);
    }
}
