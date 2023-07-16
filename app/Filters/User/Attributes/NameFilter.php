<?php

namespace App\Filters\User\Attributes;

use App\Filters\User\FilterInterface;

class NameFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->whereRaw("CONCAT(first_name, ' ' , last_name) LIKE '%{$value}%'");
    }
}
