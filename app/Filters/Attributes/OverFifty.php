<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class OverFifty implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        $subquery = DB::table('inventory_items')
            ->select('item_id', DB::raw('SUM(quantity) as sum_quantity'))
            ->groupBy('item_id')
            ->having('sum_quantity', '>=', 50);

        return $builder->joinSub($subquery, 'inventory_item_sum', function ($join) {
            $join->on('items.id', '=', 'inventory_item_sum.item_id');
        })->select('items.*');
    }
}
