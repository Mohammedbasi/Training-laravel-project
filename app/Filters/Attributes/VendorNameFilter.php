<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class VendorNameFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        $request = request();
        return $builder->join('inventory_items as ii', 'items.id', '=', 'ii.item_id')
            ->join('inventories as inv', 'inv.id', '=', 'ii.inventory_id')
            ->join('inventory_vendors as iv','inv.id','=','iv.inventory_id')
            ->join('vendors as v','v.id','=','iv.vendor_id')
            ->where('inv.id','=',$request->input('inventory_id'))
            ->where('v.id','=',$value)
            ->select('items.*');
    }
}
