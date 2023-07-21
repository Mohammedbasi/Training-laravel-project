<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'inventory_items',
            'inventory_id',
            'item_id'
        );
    }

    public function vendors()
    {
        return $this->belongsToMany(
            Vendor::class,
            'inventory_vendors',
            'inventory_id',
            'vendors_id'
        );
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','id')
            ->withDefault([
                'name'=>'-',
                'country_id'=>'-'
            ]);
    }
}
