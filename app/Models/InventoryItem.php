<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id','inventory_id','quantity',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class,'item_id','id');
    }
}
