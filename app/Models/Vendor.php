<?php

namespace App\Models;

use App\Filters\FilterFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'email',
        'created_at',
        'updated_at',
        'first_name',
        'last_name',
        'is_active',
        'phone',
        'remember_token',
    ];

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class,'addressable')
            ->withDefault([
                'city_id'=>'-',
                'street'=>'-',
                'district'=>'-',
                'phone'=>'-'
            ]);
    }

    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'vendor_items',
            'vendor_id',
            'item_id'
        )->withPivot('quantity');
    }

//    public function inventories()
//    {
//        return $this->belongsToMany(
//            Inventory::class,
//            'inventory_vendors',
//            'vendor_id',
//            'inventory_id'
//        );
//    }
    public function scopeFilter(Builder $builder, $filters)
    {
        $filterable = new FilterFactory();
        $filterable->baseFilter($builder, $filters);
    }
}
