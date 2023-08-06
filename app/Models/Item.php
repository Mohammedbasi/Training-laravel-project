<?php

namespace App\Models;

use App\Filters\FilterFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'image', 'brand_id', 'is_active',
        'price','purchasable','total_purchases','total_sales'
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

    public function vendors()
    {
        return $this->belongsToMany(
            Vendor::class,
            'vendor_items',
            'item_id',
            'vendor_id'
        )->withPivot('quantity');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        $filterable = new FilterFactory();
        $filterable->baseFilter($builder, $filters);
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('is_active', '=', 1);
    }

    public function orders()
    {
        return $this->hasMany(PurchaseOrder::class, 'item_id', 'id');
    }

    public function isQuantityLessThan50()
    {
        $totalQuantity = $this->inventories->sum('pivot.quantity');
        return $totalQuantity < 50;
    }
}
