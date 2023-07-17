<?php

namespace App\Filters;

//Filter Interface (Single Responsibility Principle)

interface FilterInterface
{
    public function applyFilter($builder,$value);
}
