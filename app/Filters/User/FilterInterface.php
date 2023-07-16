<?php

namespace App\Filters\User;

//Filter Interface (Single Responsibility Principle)

interface FilterInterface
{
    public function applyFilter($builder,$value);
}
