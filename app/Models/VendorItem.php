<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorItem extends Model
{
    use HasFactory;

    protected $table = 'vendor_items';

    public $timestamps = false;

    protected $fillable = [
        'vendor_id', 'item_id', 'quantity', 'purchase_flag'
    ];


    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

}
