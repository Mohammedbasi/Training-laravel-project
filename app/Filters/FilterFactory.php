<?php

namespace App\Filters;

use App\Filters\Attributes\AddressFilter;
use App\Filters\Attributes\BrandNameFilter;
use App\Filters\Attributes\CityNameFilter;
use App\Filters\Attributes\EmailFilter;
use App\Filters\Attributes\InventoryNameFilter;
use App\Filters\Attributes\IsActiveFilter;
use App\Filters\Attributes\IsAdminFilter;
use App\Filters\Attributes\NameFilter;
use App\Filters\Attributes\NotesFilter;
use App\Filters\Attributes\SingleNameFilter;
use App\Filters\Attributes\UsernameFilter;
use App\Filters\Attributes\PhoneFilter;
use App\Filters\Attributes\VendorNameFilter;

class FilterFactory
{
    protected static array $filters = [
        'username' => UsernameFilter::class,
        'email' => EmailFilter::class,
        'name' => NameFilter::class,
        'is_active' => IsActiveFilter::class,
        'is_admin' => IsAdminFilter::class,
        'phone' => PhoneFilter::class,
        'address' => AddressFilter::class,
        'single_name' => SingleNameFilter::class,
        'notes' => NotesFilter::class,
        'brand_id'=> BrandNameFilter::class,
        'city_id'=> CityNameFilter::class,
        'inventory_id'=> InventoryNameFilter::class,
        'vendor_id'=>VendorNameFilter::class,
    ];

    public static function createFilter($attribute)
    {
        $filterClass = self::$filters[$attribute] ?? null;

        return new $filterClass();
    }

    public function baseFilter($builder, $filters): void
    {
        foreach ($filters as $attribute => $value) {
            if (array_key_exists($attribute, self::$filters) && $value) {
                $filter = self::createFilter($attribute);
                $builder = $filter->applyFilter($builder, $value);
            }
        }
    }
}
