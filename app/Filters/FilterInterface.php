<?php

namespace App\Filters;

//Filter Interface (Single Responsibility Principle)


use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    public function applyFilter($builder,$value);
}
