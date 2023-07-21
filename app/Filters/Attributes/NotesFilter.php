<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;

class NotesFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->where('notes', 'LIKE', "%{$value}%");
    }
}
