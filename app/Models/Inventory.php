<?php

namespace App\Models;

use App\Filters\FilterFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name','city_id','phone','is_active'
    ];

    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'inventory_items',
            'inventory_id',
            'item_id'
        )->withPivot('quantity')->withTimestamps();
    }

    public function vendors()
    {
        return $this->belongsToMany(
            Vendor::class,
            'inventory_vendors',
            'inventory_id',
            'vendor_id'
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
    public function scopeFilter(Builder $builder, $filters)
    {
        $filterable = new FilterFactory();
        $filterable->baseFilter($builder, $filters);
    }
}
