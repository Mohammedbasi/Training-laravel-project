<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class NameFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->whereRaw("CONCAT(first_name, ' ' , last_name) LIKE '%{$value}%'");
    }
}
