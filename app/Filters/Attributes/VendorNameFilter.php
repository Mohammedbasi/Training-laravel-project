<?php

namespace App\Filters\Attributes;

use App\Filters\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class VendorNameFilter implements FilterInterface
{
    public function applyFilter($builder, $value)
    {
        return $builder->join('vendor_items', 'items.id', '=', 'vendor_items.item_id')
            ->join('vendors', 'vendors.id', '=', 'vendor_items.vendor_id')
            ->where('vendors.id','=',$value)
            ->select('items.*');

//            ->join('inventory_items as ii', 'items.id', '=', 'ii.item_id')
//            ->join('inventory_vendors as iv','ii.inventory_id','=','iv.inventory_id')
//            ->join('vendors as v','iv.vendor_id','=','v.id')
//            ->where('v.id','=',$value)
//            ->select('items.*')
//            ->distinct();
    }
}
