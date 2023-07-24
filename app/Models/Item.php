<?php

namespace App\Models;

use App\Filters\FilterFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name','image','brand_id','is_active'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id')
            ->withDefault([
                'name' => '-',
                'notes' => '-',
                'icon' => '-'
            ]);
    }

    public function inventories()
    {
        return $this->belongsToMany(
            Inventory::class,
            'inventory_items',
            'item_id',
            'inventory_id'
        )->withPivot('quantity');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $filterable = new FilterFactory();
        $filterable->baseFilter($builder, $filters);
    }
}
