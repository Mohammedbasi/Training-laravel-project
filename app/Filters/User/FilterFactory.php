<?php

namespace App\Filters\User;

use App\Filters\User\Attributes\EmailFilter;
use App\Filters\User\Attributes\IsActiveFilter;
use App\Filters\User\Attributes\IsAdminFilter;
use App\Filters\User\Attributes\NameFilter;
use App\Filters\User\Attributes\UsernameFilter;

class FilterFactory
{
    protected static array $filters = [
        'username' => UsernameFilter::class,
        'email' => EmailFilter::class,
        'name' => NameFilter::class,
        'is_active' => IsActiveFilter::class,
        'is_admin' => IsAdminFilter::class,
    ];

    public static function createFilter($attribute)
    {
        $filterClass = self::$filters[$attribute] ?? null;

        return new $filterClass();
    }

    public function baseFilter($builder, $filters): void
    {
        foreach ($filters as $attribute => $value) {
            if ($value) {
                $filter = self::createFilter($attribute);
                $builder = $filter->applyFilter($builder, $value);
            }
        }
    }
}
