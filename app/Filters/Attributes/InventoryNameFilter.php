<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class InventoryNameFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->join('inventory_items', 'items.id', '=', 'inventory_items.item_id')
            ->join('inventories', 'inventories.id', '=', 'inventory_items.inventory_id')
            ->where('inventories.id','=',$value)
            ->select('items.*');
    }
}
