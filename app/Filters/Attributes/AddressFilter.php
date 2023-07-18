<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class AddressFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->whereHas('address', function ($query) use ($value) {
            $query->whereHas('city', function ($query) use ($value) {
                $query->whereRaw("CONCAT(name, ' ' , street, ' ', district) LIKE '%{$value}%'");
            });

        });
//            $builder->whereRaw("CONCAT(first_name, ' ' , last_name) LIKE '%{$value}%'");
    }
}
